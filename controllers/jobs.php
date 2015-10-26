<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Jobs
 * Shows job information and job posting option
 */

$app->group('/jobs', function () use ($app) {
    
   // get job post form
    $app->get('/new', 'isJobPostAllowed', 'isBanned', function () use ($app) {
        
        global $lang;
        $token = token();
        
        $seo_title = 'Post new job | '. APP_NAME;
        $seo_desc = 'Post a new job at '. APP_NAME;
        $seo_url = BASE_URL .'jobs/new';
        
        $app->render(THEME_PATH . 'job.new.php', 
                array('lang' => $lang,
                    'seo_url'=>$seo_url, 
                    'seo_title'=>$seo_title, 
                    'seo_desc'=>$seo_desc, 
                    'token'=>$token,
                    'markdown'=>ACTIVE,
                    'filestyle'=>ACTIVE));
    });
    
    // review job
    $app->post('/review', 'isJobPostAllowed', 'isBanned', 'isValidReferrer', function () use ($app) {
        
        global $lang;

        $data = $app->request->post();
        
        if (Banlist::isBanned('email', $data['email']) 
                || Banlist::isBanned('ip', $_SERVER['REMOTE_ADDR'])) {
            $app->flash('danger', $lang->t('alert|ip_banned'));
            $app->redirect(BASE_URL . "jobs/new");
        }
        
        $data = escape($data);
        
        if ($data['trap'] != '') {
            $app->redirect(BASE_URL . "jobs/new");
        }
        
        if (isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
            $file = $_FILES['logo'];
            $path = IMAGE_PATH;
            $data['logo'] = time() .'_'. $file['name'];
            $data['logo_type'] = $file['type'];
            $data['logo_size'] = $file['size'];
            $ext = strtolower(pathinfo($data['logo'], PATHINFO_EXTENSION));
            
            if (move_uploaded_file($file['tmp_name'], "{$path}{$data['logo']}") && isValidImageExt($ext)) {                
                $resize = new ResizeImage("{$path}{$data['logo']}");
                $resize->resizeTo(LOGO_H, LOGO_W);
                $resize->saveImage("{$path}thumb_{$data['logo']}");
            } else {
                 $data['logo'] = '';
            }
        } else {
            $data['logo'] = '';
        }
        
        $data['is_featured'] = (isset($data['is_featured'])) ? 1 : 0;
        
        $j = new Jobs();
        $data['step'] = 2;

        if ($data['email'] != '' && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $id = $j->jobCreateUpdate($data);
        }

        if (!isset($id)) {
            $app->flash('danger', $lang->t('alert|error_encountered'));
            $app->redirect(BASE_URL ."jobs/new");
        } else {
            $app->redirect(BASE_URL ."jobs/{$id}/edit/{$data['token']}");
        }
        
    });
    
    // post job publish form
    $app->post('/:id/publish/:token', 'isJobPostAllowed', 'isBanned', 'isValidReferrer', function ($id, $token) use ($app) {
        
        global $lang;

        $data = $app->request->post();
        $data = escape($data);
        
        $j = new Jobs($id);
        $job = $j->getJobFromToken($token);
        
        $data['is_featured'] = (isset($data['is_featured'])) ? 1 : 0;
        
        if ($data['trap'] != '' || !$job) {
            $app->redirect(BASE_URL . "jobs/new");
        }
        if (isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
            $file = $_FILES['logo'];
            $path = IMAGE_PATH;
            $data['logo'] = time() .'_'. $file['name'];
            $data['logo_type'] = $file['type'];
            $data['logo_size'] = $file['size'];
            
            $ext = strtolower(pathinfo($data['logo'], PATHINFO_EXTENSION));
            if (move_uploaded_file($file['tmp_name'], "{$path}{$data['logo']}") && isValidImageExt($ext)) {     
                 $resize = new ResizeImage("{$path}{$data['logo']}");
                 $resize->resizeTo(LOGO_H, LOGO_W);
                 $resize->saveImage("{$path}thumb_{$data['logo']}");
            } else {
                 $data['logo'] = '';
            }
        } else {
            $data['logo'] = $job->logo;
        }
        
        $data['step'] = 3;
        
        $j->jobCreateUpdate($data);
        if (!$j->getStatus()) {
            $app->flash('success', $lang->t('alert|activation_email', $job->email));
        } else {
            $app->flash('success', $lang->t('alert|edit_successful'));
        }
        
        $app->redirect(BASE_URL . "jobs/{$id}/publish/{$token}");
    });
    
    // get publish job details 
    $app->get('/:id/publish/:token', 'isJobPostAllowed', 'isBanned', 'isValidReferrer', function ($id, $token) use ($app) {
        
        global $lang;

        $j = new Jobs($id);
        $job = $j->getJobFromToken($token);
        
        $title = $j->getSlugTitle();
        $city = $j->getJobCity($job->city);
        $category = $j->getJobCategory($job->category);
        
        if (isset($job) && $job->id) {
            
            $seo_title = clean($job->title) .' | '. APP_NAME;
            $seo_desc = excerpt($job->description);
            $seo_url = BASE_URL ."jobs/{$id}/{$title}";
            
            $app->render(THEME_PATH . 'job.publish.php', 
                        array('lang' => $lang,
                            'seo_url'=>$seo_url, 
                            'seo_title'=>$seo_title, 
                            'seo_desc'=>$seo_desc, 
                            'job'=>$job, 
                            'city'=>$city, 
                            'category'=>$category));
        } else {
            $app->flash('danger', $lang->t('alert|error_encountered'));
            $app->redirect(BASE_URL . "jobs/{$id}/{$title}");
        }        
    });
    
    // edit job
    $app->get('/:id/edit/:token', 'isJobPostAllowed', 'isBanned', function ($id, $token) use ($app) {
        
        global $lang;

        $j = new Jobs($id);
        $job = $j->getJobFromToken($token);
        $title = $j->getSlugTitle();
        
        if (isset($job) && $job) {
            $seo_title = 'Edit job | '. APP_NAME;
            $seo_desc = APP_DESC;
            $seo_url = BASE_URL;
        
            $app->render(THEME_PATH . 'job.review.php', 
                        array('lang' => $lang,
                            'seo_url'=>$seo_url, 
                            'seo_title'=>$seo_title, 
                            'seo_desc'=>$seo_desc, 
                            'job'=>$job,
                            'markdown'=>ACTIVE,
                            'filestyle'=>ACTIVE));
        } else {
            $app->flash('danger', $lang->t('alert|error_encountered'));
            $app->redirect(BASE_URL . "jobs/{$id}/{$title}");
        }
    });
    
    // delete existing job
    $app->get('/:id/delete/:token', 'isJobPostAllowed', 'isBanned', function ($id, $token) use ($app) {
        
        global $lang;

        $j = new Jobs($id);
        if ($j->deleteJob($token)) {
            $app->flash('success', $lang->t('admin|delete_success', $id));
            $app->redirect(BASE_URL);
        } else {
            $app->flash('danger', $lang->t('admin|delete_error', $id));
            $app->redirect(BASE_URL);
        }
        
    });
    
    // activate job
    $app->get('/:id/activate/:token', 'isJobPostAllowed', 'isBanned', function ($id, $token) use ($app) {
        
        global $lang;

        $j = new Jobs($id);
        $title = $j->getSlugTitle();
        
        if ($j->activateJob($token)) {
            
            $notif = new Notifications();
            $notif->sendEmailsToSubscribersMail($id);
            
            $job = $j->showJobDetails();
            $app->flash('success', $lang->t('admin|activate_success', $id));
            $app->redirect(BASE_URL . "jobs/{$id}/{$title}");
        } else {
            $app->flash('danger', $lang->t('admin|activate_error', $id));
            $app->redirect(BASE_URL);
        }
    });
    
    // deactivate job
    $app->get('/:id/deactivate/:token', 'isJobPostAllowed', 'isBanned', function ($id, $token) use ($app) {

        global $lang;
        
        $j = new Jobs($id);
        var_dump($j);
        if ($j->deactivateJob($token)) {
            $job = $j->showJobDetails();
            $title = $j->getSlugTitle();
            $app->flash('success', $lang->t('admin|deactivate_success', $id));
            $app->redirect(BASE_URL);
        } else {
            $app->flash('danger', $lang->t('admin|deactivate_error', $id));
            $app->redirect(BASE_URL);
        }
    });
    
    // show job information
    $app->get('/:id(/:title)', function ($id, $title=null) use ($app) {

        global $lang;
        
        $j = new Jobs($id);
        $job = $j->showJobDetails();
        $city = $j->getJobCity($job->city);
        $category = $j->getJobCategory($job->category);
        $applications = $j->countJobApplications();
        
        if (isset($job) && $job->id && $job->status==ACTIVE) {
            
            $seo_title = clean($job->title) .' | '. APP_NAME;
            $seo_desc = excerpt($job->description);
            $seo_url = BASE_URL ."jobs/{$id}/{$title}";
            
            $app->render(THEME_PATH . 'job.show.php', 
                    array('lang' => $lang,
                        'seo_url'=>$seo_url, 
                        'seo_title'=>$seo_title, 
                        'seo_desc'=>$seo_desc, 
                        'job'=>$job, 
                        'id'=>$id,
                        'applications'=>$applications,
                        'category'=>$category, 
                        'city'=>$city));
        } else {
            $app->redirect(BASE_URL);
        }
    }); 
    
});