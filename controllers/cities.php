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

    // rss city jobs
    $app->get('/:id/:name/rss', function ($id, $name) use ($app) {

        global $lang;

        $id = (int)$id;
        $city = new Cities($id);
        $info = $city->findCity();

        $jobs = $city->findAllCityJobs();

        $app->response->headers->set('Content-Type', 'application/rss+xml;charset=utf-8');

        $xml = new SimpleXMLElement('<rss version="2.0"></rss>');
        $xml->addChild('channel');
        $xml->channel->addChild('title', htmlentities(escapeXML($info->name)) ." ". $lang->t('jobs|jobs') .' | '. APP_NAME); 
        $xml->channel->addChild('link', BASE_URL . "cities/{$info->id}/{$info->url}");
        $xml->channel->addChild('description', htmlentities(escapeXML($info->description))); 
        foreach ($jobs as $job) { 
            $item = $xml->channel->addChild('item'); 
            $item->addChild('title', htmlentities(escapeXML($job->title))); 
            $item->addChild('link', BASE_URL . "jobs/{$job->id}/". slugify($job->title ." {$lang->t('jobs|at')} ". $job->company_name));
            $item->addChild('description', htmlentities(escapeXML($job->description))); 
            $guid = $item->addChild('guid', $job->id .'@' . BASE_URL); 
            $guid->addAttribute('isPermaLink', "false");
            $item->addChild('pubDate', date(DATE_RSS, strtotime($job->created))); 
        }
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML(html_entity_decode($xml->asXML()));
        echo $dom->saveXML();
        
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