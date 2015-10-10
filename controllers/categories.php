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