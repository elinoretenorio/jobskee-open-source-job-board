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
        
        global $lang;
        
        $token = token();
        
        $seo_title = $lang->t('apply|seo_title') .' | '. APP_NAME;
        $seo_desc = $lang->t('apply|seo_desc') .' | '. APP_NAME;
        $seo_url = BASE_URL .'apply/new';
        
        $job = new Applications($job_id);
        $title = $job->getJobTitle();
        
        $app->render(THEME_PATH . 'apply.new.php', 
                    array('lang' => $lang,
                        'seo_url'=>$seo_url, 
                        'seo_title'=>$seo_title, 
                        'seo_desc'=>$seo_desc, 
                        'token'=>$token, 
                        'job_id'=>$job_id, 
                        'job_title'=>$title,
                        'filestyle'=>ACTIVE));
    });
    
    // submit job application
    $app->post('/submit', 'isValidReferrer', 'isBanned', function () use ($app) {

        global $lang;
        
        $data = $app->request->post();
        
        if (Banlist::isBanned('email', $data['email']) 
                || Banlist::isBanned('ip', $_SERVER['REMOTE_ADDR'])) {
            $app->flash('danger', $lang->t('apply|email_ip_banned'));
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
            $app->flash('success', $lang->t('apply|msg_success'));
        } else {
            $app->flash('danger', $lang->t('apply|msg_fail'));
        }
        $title = $apply->getJobTitleURL();
        $app->redirect(BASE_URL ."jobs/{$data['job_id']}/{$title}");
    }); 
    
});