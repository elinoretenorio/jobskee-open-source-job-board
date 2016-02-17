<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Notifications class handles all outgoing notifications from Jobskee
 */

class Notifications {
    
    protected $app_name;
    protected $email_footer;

    public function __construct() 
    {
        $this->app_name = APP_NAME;
        $base_url = BASE_URL;
        $this->email_footer = <<<FOOTER
            <br /><br />
            --<br />
            Thank you for using <a href="{$base_url}">{$this->app_name}</a>
FOOTER;
    }
    
    /*
     * New Job Notification
     * Send email to activate and manage job
     */
    public function jobCreateUpdateMail($data)
    {
        $message = '';
        
        $jobs_url = BASE_URL . "jobs/";
        $subject  = "Activate your job post on {$this->app_name}";
        $message .= "<p>Welcome to {$this->app_name}!</p>";
        $message .= "<p>Activate your post by clicking this link: <br />";
        $message .= "<a href={$jobs_url}{$data['id']}/activate/{$data['access']}>";
        $message .= "{$jobs_url}{$data['id']}/activate/{$data['access']}";
        $message .= "</a></p>";
        $message .= "<p>Edit your job:<br />";
        $message .= "<a href={$jobs_url}{$data['id']}/edit/{$data['token']}>";
        $message .= "{$jobs_url}{$data['id']}/edit/{$data['token']}";
        $message .= "</a></p>";
        $message .= "<p>Deactivate your job:<br />";
        $message .= "<a href={$jobs_url}{$data['id']}/deactivate/{$data['access']}>";
        $message .= "{$jobs_url}{$data['id']}/deactivate/{$data['token']}";
        $message .= "</a></p>";
        $message .= "<p>Delete your job:<br />";
        $message .= "<a href={$jobs_url}{$data['id']}/delete/{$data['token']}>";
        $message .= "{$jobs_url}{$data['id']}/delete/{$data['token']}";
        $message .= "</a></p>";
        if ($this->sendNotification($subject, $message, $data['email'])) {
            return true;
        }
        return false;
    }


    /*
     * Job Application Notifications
     * Send email application to job poster
     */
    public function applyForJobMail($data)
    {
        $message = '';
        
        $cover_letter = nl2br($data['cover_letter']);
        $subject  = "Job application for {$data['title']} posted at {$this->app_name}";
        $message .= "<p>An application was sent to a job you posted.</p>";
        $message .= "<p><strong>Full Name:</strong> {$data['full_name']}</p>";
        $message .= "<p><strong>Email:</strong> {$data['email']}</p>";
        $message .= "<p><strong>Location:</strong> {$data['location']}</p>";
        $message .= "<p><strong>Websites:</strong> {$data['websites']}</p>";
        $message .= "<p><strong>Cover Letter:</strong> {$cover_letter}</p>";
        if ($this->sendNotification($subject, $message, $data['recipient'], $data['attachment'])) {
            return true;
        }
        return false;
    }

    /*
     * Subscription Notifications
     * Send all subscription related emails
     */
    public function createSubscriptionMail($id, $token, $recipient, $subscription_for)
    {
        $message = '';
        
        $link = BASE_URL . "subscribe/{$id}/confirm/{$token}";
        
        $subject = "Please confirm your subscription at {$this->app_name}";
        $message .= "<p>You subcribed to receive {$subscription_for} jobs on {$this->app_name}.</p>";
        $message .= "<p>To activate your subscription, click this link to start receiving alerts.</p>";
        $message .= "<p><a href={$link}>{$link}</a></p>";
        if ($this->sendNotification($subject, $message, $recipient)) {
            return true;
        }
        return false;
    }
    
    public function updateSubscriptionMail($recipient, $id, $token, $subscription_for)
    {
        $message = '';
        
        $link = BASE_URL . "subscribe/{$id}/delete/{$token}";
        
        $subject  = "Thank you for confirming your subscription at {$this->app_name}";
        $message .= "<p>You subcribed to receive {$subscription_for} jobs on {$this->app_name}.</p>";
        $message .= "<p>To unsubscribe, click this link to stop receiving alerts.</p>";
        $message .= "<p><a href={$link}>{$link}</a></p>";
        if ($this->sendNotification($subject, $message, $recipient)) {
            return true;
        }
        return false;
    }
    
    public function sendEmailsToSubscribersMail($job_id)
    {
        global $categories, $cities;
        $message = '';
        $content = '';
        
        // get job information
        $j = new Jobs($job_id);
        $job = $j->showJobDetails();
        $title = $j->getSlugTitle();
        
        $category_name = $categories[$job->category]['name'];
        $city_name = $cities[$job->city]['name'];
        $job_link = BASE_URL . "jobs/{$job->id}/{$title}";
        $description = Parsedown::instance()->parse($job->description);
        
        $content .= "<p>Job Details</p>";
        $content .= "<p>-----------</p>";
        $content .= "<p><a href={$job_link}>{$job_link}</a></p>";
        $content .= "<p>Title: <strong>{$job->title}</strong></p>";
        $content .= "<p>Description: {$description}</p>";
        if ($job->perks != '') {
            $content .= "<p>Perks: {$job->perks}</p>";
        }
        $content .= "<p>How to apply: {$job->how_to_apply}</p>";
        $content .= "<p>-----------</p>";
        
        // get all users subscribed to the job
        $users = R::findAll('subscriptions', " is_confirmed=1 AND (category_id=:category_id OR city_id=:city_id) ", 
                    array(':category_id'=>$job->category, ':city_id'=>$job->city));
        
        foreach ($users as $user) {
            
            $link = BASE_URL . "subscribe/{$user->id}/delete/{$user->token}";
            
            $name = ($user->category_id > 0) ? $category_name : $city_name;
            
            $subject = "A new {$name} job was posted at {$this->app_name}";

            $message = '';
            $message .= "<p>You subcribed to receive {$name} jobs on {$this->app_name}.</p>";
            $message .= $content;
            $message .= "<p>To unsubscribe, click this link to stop receiving alerts.</p>";
            $message .= "<p><a href={$link}>{$link}</a></p>";
                       
            if ($this->sendNotification($subject, $message, $user->email)) {
                $update = R::load('subscriptions', $user->id);
                $update->last_sent = R::isoDateTime();
                R::store($update);
            }
        }
    }
    
    /*
     * General email notification sender
     */
    protected function sendNotification($subject, $message, $recipient, $attachment=null)
    {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        if (SMTP_ENABLED) {
            $mail->isSMTP();
        }
        if (SMTP_AUTH) {
            $mail->SMTPAuth = SMTP_AUTH;
            $mail->SMTPSecure = SMTP_SECURE;
        }
        if (APP_MODE == 'development') {
            $mail->SMTPDebug = 1;
        }
        $mail->Host = SMTP_URL;
        $mail->Port = SMTP_PORT;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->setFrom(SMTP_USER, APP_NAME . ' Admin');
        $mail->Subject = $subject;
        $mail->Body = $message . $this->email_footer;
        $mail->AddAddress($recipient);
        
        $file = ATTACHMENT_PATH . $attachment;
        if ($attachment != '' && file_exists($file)) {
            $mail->addAttachment($file);
        }
        
        try {
            if ($mail->Send()) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}

