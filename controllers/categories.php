<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Categories
 * Shows jobs per category
 */

$app->group('/categories', function () use ($app) {
    
    // get categories index
    $app->get('/', function () use ($app) {
        $app->redirect(BASE_URL);
    });

    // rss category jobs
    $app->get('/:id/:name/rss', function ($id, $name) use ($app) {

        global $lang;

        $id = (int)$id;
        $cat = new Categories($id);
        $info = $cat->findCategory();

        $jobs = $cat->findAllCategoryJobs();

        $app->response->headers->set('Content-Type', 'application/rss+xml;charset=utf-8');

        $xml = new SimpleXMLElement('<rss version="2.0"></rss>');
        $xml->addChild('channel');
        $xml->channel->addChild('title', htmlentities(escapeXML($info->name)) ." ". $lang->t('jobs|jobs') .' | '. APP_NAME); 
        $xml->channel->addChild('link', BASE_URL . "categories/{$info->id}/{$info->url}");
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
    
    // get category jobs
    $app->get('/:id(/:name(/:page))', function ($id, $name=null, $page=1) use ($app) {
        
        global $lang;
        
        $id = (int)$id;
        $cat = new Categories($id);
        $categ = $cat->findCategory();
        
        if (isset($categ) && $categ) {
            
            $start = getPaginationStart($page);
            $count = $cat->countCategoryJobs();
            $number_of_pages = ceil($count/LIMIT);
            $jobs = $cat->findCategoryJobs($start, LIMIT);

            $seo_title = $categ->name .' | '. APP_NAME;
            $seo_desc = excerpt($categ->description);
            $seo_url = BASE_URL ."categories/{$id}/{$name}";
        
            $app->render(THEME_PATH . 'categories.php', 
                        array('lang' => $lang,
                            'seo_url'=>$seo_url, 
                            'seo_title'=>$seo_title, 
                            'seo_desc'=>$seo_desc, 
                            'categ'=>$categ, 
                            'jobs'=>$jobs,
                            'id' => $id,
                            'number_of_pages'=>$number_of_pages,
                            'current_page'=>$page,
                            'page_name'=>'categories'));
        } else {
            $app->flash('danger', $lang->t('alert|page_not_found'));
            $app->redirect(BASE_URL, 404);
        }
        
    }); 
});