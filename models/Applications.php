<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Application class handles job application sent through Jobskee
 */

class Applications
{
    private $_job_id;
    
    public function __construct($job_id=null) 
    {
        if (isset($job_id)) {
            $this->_job_id = $job_id;
        }
    }
    
    public function getJobTitle() 
    {
        $job = R::load('jobs', $this->_job_id);
        return $job->title;
    }
    
    public function getJobTitleURL() 
    {
        global $lang;
        $job = R::load('jobs', $this->_job_id);
        $job_url = $job->title ." {$lang->t('jobs|at')} ". $job->company_name;
        return slugify($job_url);
    }

    public function applyForJob($data) {
        
        $apply = R::dispense('applications');
        $apply->job_id = $this->_job_id;
        $apply->cover_letter = $data['cover_letter'];
        $apply->full_name = $data['full_name'];
        $apply->email = $data['email'];
        $apply->location = $data['location'];
        $apply->websites = $data['websites'];
        $apply->attachment = $data['attachment'];
        $apply->token = $data['token'];
        $apply->created = R::isoDateTime();
        $id = R::store($apply);
        
        $job = R::load('jobs', $this->_job_id);
        
        $data['title'] = $job->title;
        $data['recipient'] = $job->email;
        
        $notif = new Notifications();
        if ($notif->applyForJobMail($data)) {
            return $id;
        }
        return false;
        
        
    }
    
    public function countJobApplications()
    {
        $count = R::count('applications',' job_id=:job_id ', array(':job_id'=>$this->job_id));
        return $count;
    }
    
    public function getApplications($start)
    {
        if (isset($this->_job_id)) {
            $apps = R::findAll('applications', " job_id=:job_id ORDER BY created DESC LIMIT :start, :limit ", array(':job_id'=>$this->_job_id, ':start'=>$start, ':limit'=>LIMIT));
        } else {
            $apps = R::findAll('applications', " ORDER BY created DESC LIMIT :start, :limit ", array(':start'=>$start, ':limit'=>LIMIT));
        }
        return $apps;
    }
    
    public function countApplications()
    {
        if (isset($this->_job_id)) {
            $apps = R::count('applications', ' job_id=:job_id ORDER BY created DESC ', array(':job_id'=>$this->_job_id));
        } else {
            $apps = R::count('applications', ' ORDER BY created DESC ');
        }
        return $apps;
    }
}