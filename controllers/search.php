<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Search
 * Search for jobs
 */

$app->group('/search', function () use ($app) {
    
   $app->post('/', function () use ($app) {
        
        $data = $app->request->post('terms');
        
        $terms = escape($data);
        $terms = urlencode($terms);
        
        $app->redirect(BASE_URL . "search/{$terms}");
    });

    $app->get('(/:terms)', 'isBanned', function ($terms='') use ($app) {
        
        global $lang;
        $s = new Search();
        
        $jobs = $s->searchJobs($terms);
        $count = $s->countJobs($terms);
        
        $app->render(THEME_PATH . 'search.php', 
                    array('lang' => $lang,
                        'terms'=>$terms,
                        'count'=>$count,
                        'seo_url'=>BASE_URL . 'search', 
                        'seo_title'=>$lang->t('search|search_result') .' '. APP_NAME, 
                        'seo_desc'=>$lang->t('search|search_result') .' '. APP_NAME,
                        'jobs'=>$jobs));
        
    }); 
    
});