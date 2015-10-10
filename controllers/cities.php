<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Cities
 * Shows jobs per city
 */

$app->group('/cities', function () use ($app) {
    
    // get cities index
    $app->get('/', function () use ($app) {
        $app->redirect(BASE_URL);
    });
    
    // get city jobs
    $app->get('/:id(/:name(/:page))', function ($id, $name=null, $page=1) use ($app) {
        
        global $lang;

        $id = (int)$id;
        $cit = new Cities($id);
        $city = $cit->findCity();
        
        if (isset($city) && $city) {
            
            $start = getPaginationStart($page);
            $count = $cit->countCityJobs();
            $number_of_pages = ceil($count/LIMIT);
            $jobs = $cit->findCityJobs($start, LIMIT);

            $seo_title = $city->name .' | '. APP_NAME;
            $seo_desc = excerpt($city->description);
            $seo_url = BASE_URL ."cities/{$id}/{$name}";
        
            $app->render(THEME_PATH . 'cities.php', 
                        array('lang' => $lang,
                            'seo_url'=>$seo_url, 
                            'seo_title'=>$seo_title, 
                            'seo_desc'=>$seo_desc,
                            'city'=>$city,
                            'jobs'=>$jobs,
                            'id' => $id,
                            'number_of_pages'=>$number_of_pages,
                            'current_page'=>$page,
                            'page_name'=>'cities'));
        } else {
            $app->flash('danger', $lang->t('alert|page_not_found'));
            $app->redirect(BASE_URL, 404);
        }
        
    });
});