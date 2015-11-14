<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Jobs class handles all operations related to jobs
 */

class Jobs 
{
    
    private $_id;
    private $_job;
    
    public function __construct($id=0) 
    {
        $this->_id = $id;
        $this->_job = R::load('jobs', $id);
    }
    
    public function countJobApplications()
    {
        $count = R::count('applications',' job_id=:job_id ', array(':job_id'=>$this->_id));
        return $count;
    }
    
    public function getJobFromToken($token)
    {
        $job = R::findOne('jobs', ' id=:id AND token=:token ', array(':id'=>$this->_id, ':token'=>$token));
        if (isset($job) && $job->id) {
            return $job;
        }
        return false;
    }
    
    public function getJobCity($city_id)
    {
        $city = R::load('cities', $city_id);
        return $city->name;
    }
    
    public function getJobCategory($category_id)
    {
        $category = R::load('categories', $category_id);
        return $category->name;
    }


    public function showJobDetails()
    {
        return $this->_job;
    }


    public function jobCreateUpdate($data, $status=INACTIVE)
    {
        if (isset($data['id']) && $data['id'] != '' && $this-> getJobFromToken($data['token'])) {
            $job = R::load('jobs', $data['id']);
            $data['email'] = $job->email;
        } else {
            $job = R::dispense('jobs');
            $job->created = R::isoDateTime();
            $job->email = $data['email'];
            $job->token = $data['token'];
            $job->status = $status;
        }
        
        $job->title = $data['title'];
        $job->category = $data['category'];
        $job->city = $data['city'];
        $job->description = $data['description'];
        $job->perks = $data['perks'];
        $job->how_to_apply = $data['how_to_apply'];
        $job->company_name = $data['company_name'];
        $job->logo = $data['logo'];
        $job->url = $data['url'];
        $job->is_featured = $data['is_featured'];
        $id = R::store($job);
        
        $data['access'] = accessToken($id);
        
        // send user an email if job is inactive
        if (!$job->status && $data['step'] == 3) {
            $notif = new Notifications();
            if ($notif->jobCreateUpdateMail($data)) {
                return true;
            }
        }
        
        if ($id > 0) {
            return $id;
        } 
        return false;
    }
    
    public function featureJob($token, $action='on') 
    {
        $job = $this->getJobFromToken($token);
        
        if ($job && $job->id) {
            $action = ($action == 'on') ? ACTIVE : INACTIVE;
            $job->is_featured = $action;
            R::store($job);
            return true;
        }
        return false;
    }
    
    public function deleteJob($token) 
    {
        $job = $this->getJobFromToken($token);
        if ($job && ($job->id)) {
            R::trash($job);
            return true;
        }
        return false;
    }
    
    public function expireJobs() 
    {
        $sql = "UPDATE jobs SET status = 0 WHERE created < (NOW() - INTERVAL ". EXPIRE_JOBS ." DAY)";
        if (R::exec($sql)) {
            return true;
        }
        return false;
    }
    
    public function activateJob($token) 
    {
        $job = $this->showJobDetails();
        if ($token == accessToken($job->id)) {
            $job->status = ACTIVE;
            R::store($job);
            return true;
        }
        return false;
    }
    
    public function deactivateJob($token) 
    {
        $job = $this->showJobDetails();
        if ($token == accessToken($job->id)) {
            $job->status = INACTIVE;
            R::store($job);
            return true;
        }
        return false;
    }
    
    public function getJobs($status=1, $category=1, $start=null, $limit=null)
    {
        if (!is_null($start) && !is_null($limit)) {
            $jobs = R::findAll('jobs', 
                    " status=:status AND category=:category ORDER BY created DESC LIMIT :start, :limit", 
                    array(':status'=>$status, ':category'=>$category, ':start'=>$start, ':limit'=>$limit));
        } else {
            $jobs = R::findAll('jobs', 
                    " status=:status AND category=:category ORDER BY created DESC", 
                    array(':status'=>$status, ':category'=>$category));
        }
        return $jobs;
    }
    
    public function getStatus()
    {
        $job = $this->showJobDetails();
        return $job->status;
    }
    
    public function getSlugTitle()
    {
        global $lang;
        $job = $this->showJobDetails();
        return slugify($job->title ." {$lang->t('jobs|at')} ". $job->company_name);
    }
    
    public function getSeoTitle() 
    {
        global $lang;
        $job = $this->showJobDetails();
        return $job->title ." {$lang->t('jobs|at')} ". $job->company_name;
    }
    
}
