<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Cron
 * List of available cron jobs
 */

$app->group('/cron', function () use ($app) {
    
    // expire jobs
    $app->get('/jobs/expire/:cron_token', function ($cron_token) use ($app) {
        
        if (trim($cron_token) == CRON_TOKEN) {
            $j = new Jobs();
            $j->expireJobs();
            echo true;
            exit();
        }
    });
    
});
