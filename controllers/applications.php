<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Applications
 * Job application form submission
 */

$app->group('/apply', function () use ($app) {
    
    // get job post form
    $app->get('/:job_id(/)', 'isBanned', function ($job_id) use ($app) {
        
        $token = token();
        
        $seo_title = 'Apply for a job | '. APP_NAME;
        $seo_desc = 'Apply for a job at '. APP_NAME;
        $seo_url = BASE_URL .'apply/new';
        
        $job = new Applications($job_id);
        $title = $job->getJobTitle();
        
        $app->render(THEME_PATH . 'apply.new.php', 
                    array('seo_url'=>$seo_url, 
                        'seo_title'=>$seo_title, 
                        'seo_desc'=>$seo_desc, 
                        'token'=>$token, 
                        'job_id'=>$job_id, 
                        'job_title'=>$title,
                        'filestyle'=>ACTIVE));
    });
    
    // submit job application
    $app->post('/submit', 'isBanned', function () use ($app) {
        
        $data = $app->request->post();
        
        if (Banlist::isBanned('email', $data['email']) 
                || Banlist::isBanned('ip', $_SERVER['REMOTE_ADDR'])) {
            $app->flash('danger', "Your email address or IP is not allowed to apply for this job.");
            $app->redirect(BASE_URL . "apply/{$data['job_id']}");
        }
        
        $data = escape($data);
        
        if ($data['trap'] != '') {
            $app->redirect(BASE_URL . "apply/{$data['job_id']}");
        }
        
        if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != '') {
            $file = $_FILES['attachment'];
            $path = ATTACHMENT_PATH;
            $attachment = time() .'_'. $file['name'];
            $data['attachment_type'] = $file['type'];
            $data['attachment_size'] = $file['size'];
            
            if (move_uploaded_file($file['tmp_name'], "{$path}{$attachment}")) {
                 $data['attachment'] = $attachment;
            }
        } else {
            $data['attachment'] = '';
        }
        
        $apply = new Applications($data['job_id']);
        if ($apply->applyForJob($data)) {
            $app->flash('success', 'Application has been successfully sent.');
        } else {
            $app->flash('danger', 'Application could not be sent.');
        }
        $title = $apply->getJobTitleURL();
        $app->redirect(BASE_URL ."jobs/{$data['job_id']}/{$title}");
    }); 
    
});