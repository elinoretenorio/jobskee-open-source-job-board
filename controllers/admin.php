<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Admin
 * Jobskee admin panel
 */

define('ADMIN_MANAGE', ADMIN_URL . 'manage');

/*
 * Admin
 * Show admin options
 */

$app->group('/admin', function () use ($app) {
    
   // admin default
    $app->get('/', function () use ($app) {
        if (userIsValid()) {
            $app->redirect(ADMIN_MANAGE);
        } else {
            $app->redirect(LOGIN_URL);
        }
    });
    
    // login admin form
    $app->get('/login', function () use ($app) {
        
        global $lang;

        $val = array('lang' => $lang,
                    'seo_title' => APP_NAME,
                    'seo_desc' => APP_DESC,
                    'seo_url' => ADMIN_URL);
        
        if (trim($app->request->get('user')) == 'invalid') {
            $val['invalid'] = 'yes';
        }
        
        $app->render(ADMIN_THEME . 'login.php', $val);
    });
    
    // authenticate user
    $app->post('/authenticate', 'isValidReferrer', function () use ($app) {
        
        global $lang;

        $data = $app->request->post();
        $admin = R::findOne('admin', ' email=:email AND password=:password ', array(':email'=>$data['email'], ':password'=>sha1($data['password'])));
        if (isset($admin) && $admin->id) {
            
            $_SESSION['is_admin'] = true;
            $_SESSION['email'] = $data['email'];
            
            $app->redirect(ADMIN_MANAGE);
        } else {
            $app->flash('danger', $lang->t('admin|invalid_login'));
            $app->redirect(LOGIN_URL);
        }
    });
    
    // logout admin
    $app->get('/logout', 'validateUser', function () use ($app) {

        global $lang;
        
        unset($_SESSION['email']);
        unset($_SESSION['is_admin']);
        $app->flash('success', $lang->t('admin|logout_success'));
        $app->redirect('login');
    });
    
    /*
     * Manage group
     * Manage inactive jobs, categories list, cities list
     */
    $app->group('/manage', function () use ($app) {
        
        // manage inactive jobs
        $app->get('/', 'validateUser', function () use ($app) {

            global $categories;
            global $lang;

            $j = new Jobs();
            foreach ($categories as $cat) {
                $jobs[$cat->id] = $j->getJobs(INACTIVE, $cat->id);
            }

            $app->render(ADMIN_THEME . 'home.php', 
                        array('lang' => $lang,
                        'jobs'=>$jobs));
        });
        
        /*
        * Manage categories group
        */
       $app->group('/categories', function () use ($app) {
           
           $app->post('/', 'isValidReferrer', 'validateUser', function () use ($app) {

               global $lang;
               
               $data = $app->request->post();
               $c = new Categories($data['id']);
               $c->addCategory($data);
               if ($data && $data['id'] != '')
                    $message = $lang->t('admin|category_update');
               else {
                    $message = $lang->t('admin|category_new');
               }
               $app->flash('success', $message); 
               $app->redirect(ADMIN_MANAGE . '/categories');
           });
           
           $app->get('(/(:id(/:action)))', 'validateUser', function ($id=null,$action=null) use ($app) {
               
               global $lang;

               $category = null;
               $c = new Categories($id);
               if ($id && $action == 'edit') {
                    $category = $c->findCategory();
               } elseif ($id && $action == 'delete') {
                    if ($c->deleteCategory()) {
                        $app->flash('success', $lang->t('admin|category_delete'));
                    } else {
                        $app->flash('danger', $lang->t('admin|category_not_delete'));
                    }
                    $app->redirect(ADMIN_MANAGE . '/categories');
               }
               $categories = Categories::findCategories();
               
               $app->render(ADMIN_THEME . 'categories.edit.php', array('lang' => $lang, 'categs'=>$categories, 'category'=>$category));

           });

       });
       
       /*
        * Manage cities group
        */
       $app->group('/cities', function () use ($app) {
           
           $app->post('/', 'isValidReferrer', 'validateUser', function () use ($app) {

               global $lang;
               
               $data = $app->request->post();
               $c = new Cities($data['id']);
               $c->addCity($data);
               if ($data && $data['id'] != '')
                    $message = $lang->t('admin|city_update');
               else {
                    $message = $lang->t('admin|city_new');
               }
               $app->flash('success', $message); 
               $app->redirect(ADMIN_MANAGE . '/cities');
           });
           
           $app->get('(/(:id(/:action)))', 'validateUser', function ($id=null,$action=null) use ($app) {
               
               global $lang;

               $city = null;
               $c = new Cities($id);
               if ($id && $action == 'edit') {
                    $city = $c->findCity();
               } elseif ($id && $action == 'delete') {
                    $c->deleteCity();
                    if ($c->deleteCity()) {
                        $app->flash('success', $lang->t('admin|city_delete'));
                    } else {
                        $app->flash('danger', $lang->t('admin|city_not_delete'));
                    }
                    $app->redirect(ADMIN_MANAGE . '/cities');
               }
               $cities = Cities::findCities();
               
               $app->render(ADMIN_THEME . 'cities.edit.php', array('lang' => $lang, 'cits'=>$cities, 'city'=>$city));

           });

       });

        
    });
    
    /*
     * Jobs group
     * Admin jobs routes
     */
    $app->group('/jobs', function () use ($app) {
        
        // upload jobs from csv
        $app->get('/upload', 'validateUser', function () use ($app) {

            global $lang;

            $app->render(ADMIN_THEME . 'upload.php', array('lang' => $lang, 'filestyle'=>ACTIVE));
        });
        
        // process csv file
        $app->post('/upload', 'isValidReferrer', 'validateUser', function () use ($app) {

            global $lang;
            
            $data = array();
            if (isset($_FILES['csv']) && $_FILES['csv']['name'] != '') {
                $file = $_FILES['csv'];
                $path = ATTACHMENT_PATH;
                $data['csv'] = time() . '_' . $file['name'];
                $data['type'] = $file['type'];
                $data['csv_size'] = $file['size'];
                
                $csv = "{$path}{$data['csv']}"; 

                if ($data['type'] == 'text/csv' && move_uploaded_file($file['tmp_name'], $csv)) {
                    
                    $added = 0;
                    $skipped = 0;

                    $file = new SplFileObject($csv);
                    $file->setFlags(SplFileObject::READ_CSV);
                    foreach ($file as $data) {

                        // check if the csv file has the right number of fields
                        if (count($data) == CSV_FIELDS) {
                            
                            $featured = (isset($data[9]) && $data[9] == 'featured') ? 1 : 0;
                            
                            $job = array('title'=>$data[0],
                                'category'=>$data[1],
                                'city'=>$data[2],
                                'description'=>$data[3],
                                'perks'=>$data[4],
                                'how_to_apply'=>$data[5],
                                'company_name'=>$data[6],
                                'url'=>$data[7],
                                'email'=>$data[8],
                                'logo'=>'',
                                'is_featured'=>$featured,
                                'token'=>token(),
                                'step'=>3);

                            $j = new Jobs();
                            $j->jobCreateUpdate($job, ACTIVE);
                            
                            $added++;
                        } else {
                            $skipped++;
                        }
                    }

                    // remove csv file
                    if (file_exists($csv)) {
                        unlink($csv);
                    }
                    $app->flash('success', $lang->t('admin|upload_success', $added));
                    $app->redirect(ADMIN_URL . 'jobs/upload');
                    
                } else {
                    $app->flash('danger', $lang->t('admin|upload_invalid'));
                    $app->redirect(ADMIN_URL . 'jobs/upload');
                }
            } else {
                $app->flash('danger', $lang->t('admin|upload_none'));
                $app->redirect(ADMIN_URL . 'admin/upload');
            }
            
        });
        
        // expire jobs after X days
        $app->get('/expire', 'validateUser', function () use ($app) {

            global $lang;
            
            $j = new Jobs();
            $j->expireJobs();
            
            $app->flash('success', $lang->t('admin|expire_success'));
            $app->redirect(ADMIN_MANAGE);
        });

        // get job post form
        $app->get('/new', 'validateUser', function () use ($app) {

            global $lang;
            
            $token = token();
            $app->render(ADMIN_THEME . 'job.new.php', 
                        array('lang' => $lang,
                            'token'=>$token,
                            'markdown'=>ACTIVE,
                            'filestyle'=>ACTIVE));
        });

        // review job
        $app->post('/review', 'isValidReferrer', 'validateUser', function () use ($app) {

            global $lang;
            
            $data = $app->request->post();
            $data = escape($data);

            if ($data['trap'] != '') {
                $app->redirect(ADMIN_URL . "jobs/new");
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
            
            $data['is_featured'] = (isset($data['is_featured'])) ? ACTIVE : INACTIVE;

            $j = new Jobs();
            $data['step'] = 2;
            $id = $j->jobCreateUpdate($data, ACTIVE);

            $app->redirect(ADMIN_URL ."jobs/{$id}/edit/{$data['token']}");
        });

        // post job publish form
        $app->post('/:id/publish/:token', 'isValidReferrer', 'validateUser', function ($id, $token) use ($app) {

            global $lang;
            
            $data = $app->request->post();
            $data = escape($data);

            $j = new Jobs($id);
            $job = $j->getJobFromToken($token);

            $data['is_featured'] = (isset($data['is_featured'])) ? 1 : 0;

            if ($data['trap'] != '') {
                $app->redirect(ADMIN_URL . "jobs/new");
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
                }
            } else {
                $data['logo'] = $job->logo;
            }
            
            $data['step'] = 3;
            $j->jobCreateUpdate($data, ACTIVE);
            $app->redirect(ADMIN_URL . "jobs/{$id}/publish/{$token}");
        });

        // get publish job details 
        $app->get('/:id/publish/:token', 'validateUser', function ($id, $token) use ($app) {
            
            global $lang;

            $j = new Jobs($id);
            $job = $j->getJobFromToken($token);
            $title = $j->getSlugTitle();
            $city = $j->getJobCity($job->city);
            $category = $j->getJobCategory($job->category);

            if (isset($job) && $job->id) {
                $app->render(ADMIN_THEME . 'job.publish.php', 
                        array('lang' => $lang,
                            'job'=>$job, 
                            'city'=>$city, 
                            'category'=>$category));
            } else {
                $app->redirect(ADMIN_URL . "jobs/{$id}/{$title}");
            }        
        });

        // edit job
        $app->get('/:id/edit/:token', 'validateUser', function ($id, $token) use ($app) {
            
            global $lang;

            $j = new Jobs($id);
            $job = $j->getJobFromToken($token);

            if (isset($job) && $job->id) {
                $app->render(ADMIN_THEME . 'job.review.php', 
                            array('lang' => $lang,
                                'job'=>$job,
                                'markdown'=>ACTIVE,
                                'filestyle'=>ACTIVE));
            } else {
                $job = $j->showJobDetails();
                $title = $j->getSlugTitle();

                $app->redirect(ADMIN_URL . "jobs/{$job->id}/{$title}");
            }
        });
        
        // feature job
        $app->get('/:id/feature/:action/:token', 'validateUser', function ($id, $action, $token) use ($app) {

            global $lang;
            
            $j = new Jobs($id);
            $title = $j->getSlugTitle();
            if ($j->featureJob($token, $action)) {
                $app->flash('success', $lang->t('admin|feature_success', $action));
                $app->redirect(ADMIN_URL . "jobs/{$id}/{$title}");
            } else {
                $app->flash('danger', $lang->t('admin|feature_error'));
                $app->redirect(ADMIN_URL . "jobs/{$id}/{$title}");
            }
        });

        // delete existing job
        $app->get('/:id/delete/:token', 'validateUser', function ($id, $token) use ($app) {

            global $lang;
            
            $j = new Jobs($id);
            if ($j->deleteJob($token)) {
                $app->flash('success', $lang->t('admin|delete_success', $id));
                $app->redirect(ADMIN_URL);
            } else {
                $app->flash('danger', $lang->t('admin|delete_error', $id));
                $app->redirect(ADMIN_MANAGE);
            }
        });

        // activate job
        $app->get('/:id/activate/:token', 'validateUser', function ($id, $token) use ($app) {

            global $lang;
            
            $j = new Jobs($id);
            if ($j->activateJob($token)) {
                $job = $j->showJobDetails();
                $title = $j->getSlugTitle();
                
                $notif = new Notifications();
                $notif->sendEmailsToSubscribersMail($id);
                
                $app->flash('success', $lang->t('admin|activate_success', $id));
                $app->redirect(ADMIN_URL . "jobs/{$job->id}/{$title}");
            } else {
                $app->flash('danger', $lang->t('admin|activate_error', $id));
                $app->redirect(ADMIN_URL . "jobs/{$id}");
            }
        });
        
        // deactivate job
        $app->get('/:id/deactivate/:token', 'validateUser', function ($id, $token) use ($app) {

            global $lang;
            
            $j = new Jobs($id);
            if ($j->deactivateJob($token)) {
                $job = $j->showJobDetails();
                $title = $j->getSlugTitle();
                $app->flash('success', $lang->t('admin|deactivate_success', $id));
                $app->redirect(ADMIN_URL . "jobs/{$job->id}/{$title}");
            } else {
                $app->flash('danger', $lang->t('admin|deactivate_error', $id));
                $app->redirect(ADMIN_URL . "jobs/$id");
            }
        });
        
        // show job information
        $app->get('/:id(/:title)', 'validateUser', function ($id, $title=null) use ($app) {
            
            global $lang;

            $j = new Jobs($id);
            $job = $j->showJobDetails();
            $city = $j->getJobCity($job->city);
            $category = $j->getJobCategory($job->category);
            $applications = $j->countJobApplications();

            if (isset($job) && $job->id) {
                $app->render(ADMIN_THEME . 'job.show.php', 
                        array('lang' => $lang,
                            'job'=>$job, 
                            'id'=>$id,
                            'applications'=>$applications,
                            'category'=>$category, 
                            'city'=>$city));
            } else {
                $app->flash('danger', $lang->t('admin|not_found'));
                $app->redirect(ADMIN_MANAGE);
            }
        });
        
    });
    
    /*
     * Categories group
     * Admin job categories routes
     */
    $app->group('/categories', function () use ($app) {
        
        $app->get('/', 'validateUser', function () use ($app) {
            $app->redirect(ADMIN_MANAGE);
        });

        // get category jobs
        $app->get('/:id(/:name(/:page))', 'validateUser', function ($id, $name=null, $page=1) use ($app) {
            
            global $lang;

            $id = (int)$id;
            $cat = new Categories($id);
            $start = getPaginationStart($page);
            $count = $cat->countCategoryJobs();
            $number_of_pages = ceil($count/LIMIT);

            $categ = $cat->findCategory();
            $jobs = $cat->findCategoryJobs($start, LIMIT);

            if (isset($categ) && $categ) {
                $app->render(ADMIN_THEME . 'categories.php', 
                            array('lang' => $lang,
                                'categ'=>$categ, 
                                'jobs'=>$jobs,
                                'id' => $id,
                                'number_of_pages'=>$number_of_pages,
                                'current_page'=>$page,
                                'page_name'=>'categories'));
            } else {
                $app->redirect(ADMIN_MANAGE);
            }
        });
        
    });
    
    /*
     * Cities group
     * Admin job cities routes
     */
    $app->group('/cities', function () use ($app) {
    
        $app->get('/', 'validateUser', function () use ($app) {
            $app->redirect(ADMIN_MANAGE);
        });

        // get category jobs
        $app->get('/:id(/:name(/:page))', 'validateUser', function ($id, $name=null, $page=1) use ($app) {
            
            global $lang;

            $id = (int)$id;
            $cit = new Cities($id);

            $start = getPaginationStart($page);
            $count = $cit->countCityJobs();
            $number_of_pages = ceil($count/LIMIT);

            $city = $cit->findCity();
            $jobs = $cit->findCityJobs($start, LIMIT);

            if (isset($city) && $city) {
                $app->render(ADMIN_THEME . 'cities.php', 
                            array('lang' => $lang,
                                'city'=>$city,
                                'jobs'=>$jobs,
                                'id' => $id,
                                'number_of_pages'=>$number_of_pages,
                                'current_page'=>$page,
                                'page_name'=>'cities'));
            } else {
                $app->redirect(ADMIN_MANAGE);
            }
        });
        
    });
    
    /*
     * Pages group
     * Manage pages
     */
    $app->group('/pages', function () use ($app) {
        
        $app->post('/', 'isValidReferrer', 'validateUser', function () use ($app) {

            global $lang;
            
            $data = $app->request->post();
            $data = escape($data);
            
            $p = new Pages();
            $p->addToPageList($data);
            $method = (isset($data['id']) && $data['id'] > 0) ? 'edited' : 'added';
            $app->flash('success', $lang->t('admin|page_success', $method));
            $app->redirect(ADMIN_URL . 'pages');
            
        });
        
        $app->get('/new', 'validateUser', function () use ($app) {

            global $lang;
            
            $app->render(ADMIN_THEME . 'pages.new.php', array('lang' => $lang, 'method'=>'new', 'markdown'=>ACTIVE));
            
        });
        
        $app->get('/edit/:id', 'validateUser', function ($id) use ($app) {

            global $lang;
            
            $p = new Pages();
            $page = $p->showPage($id);
            $app->render(ADMIN_THEME . 'pages.edit.php', array('lang' => $lang, 'page'=>$page, 'method'=>'edit', 'markdown'=>ACTIVE));
            
        });
        
        $app->get('/delete/:id', 'validateUser', function ($id) use ($app) {

            global $lang;
            
            $p = new Pages();
            $p->deleteFromPage($id);
            $app->flash('success', $lang->t('admin|page_delete'));
            $app->redirect(ADMIN_URL . 'pages');
        });
        
        $app->get('(/(:page))', 'validateUser', function ($page=1) use ($app) {

            global $lang;
            
            $p = new Pages();
            
            $start = getPaginationStart($page);
            $count = $p->countPageList();
            $number_of_pages = ceil($count/LIMIT);
            
            $pages = $p->showPageList($start, LIMIT);
            
            $app->render(ADMIN_THEME . 'pages.php', 
                    array('lang' => $lang,
                        'pages'=>$pages, 
                        'number_of_pages'=>$number_of_pages,
                        'current_page'=>$page,
                        'page_name'=>'pages'));
            
        });
        
    });
    
    /*
     * Blocks group
     * Manage block content
     */
    $app->group('/blocks', function () use ($app) {
        
        $app->post('/', 'isValidReferrer', 'validateUser', function () use ($app) {

            global $lang;
            
            $data = $app->request->post();
            
            $b = new Blocks();
            $b->addToBlockList($data);
            $method = (isset($data['id']) && $data['id'] > 0) ? 'edited' : 'added';
            $app->flash('success', $lang->t('admin|block_success', $method));
            $app->redirect(ADMIN_URL . 'blocks');
            
        });
        
        $app->get('/new', 'validateUser', function () use ($app) {

            global $lang;
            
            $app->render(ADMIN_THEME . 'blocks.new.php', array('lang' => $lang, 'method'=>'new'));
            
        });
        
        $app->get('/edit/:id', 'validateUser', function ($id) use ($app) {

            global $lang;
            
            $b = new Blocks();
            $block = $b->showBlock($id);
            $app->render(ADMIN_THEME . 'blocks.edit.php', array('lang' => $lang, 'block'=>$block, 'method'=>'edit'));
            
        });
        
        $app->get('/delete/:id', 'validateUser', function ($id) use ($app) {

            global $lang;
            
            $b = new Blocks();
            $b->deleteFromBlock($id);
            $app->flash('success', $lang->t('admin|block_delete'));
            $app->redirect(ADMIN_URL . 'blocks');
        });
        
        $app->get('(/(:page))', 'validateUser', function ($page=1) use ($app) {

            global $lang;
            
            $b = new Blocks();
            
            $start = getPaginationStart($page);
            $count = $b->countBlockList();
            $number_of_pages = ceil($count/LIMIT);
            
            $blocks = $b->showBlockList($start, LIMIT);
            
            $app->render(ADMIN_THEME . 'blocks.php', 
                    array('lang' => $lang,
                        'blocks'=>$blocks, 
                        'number_of_pages'=>$number_of_pages,
                        'current_page'=>$page,
                        'page_name'=>'blocks'));
            
        });
        
    });
    
    /*
     * Banlist group
     * Manage ban list
     */
    $app->group('/ban', function () use ($app) {
        
        $app->post('/', 'isValidReferrer', 'validateUser', function () use ($app) {

            global $lang;
            
            $ban = new Banlist();
            $data = $app->request->post();
            $ban->addToList($data['type'], $data['value']);
            
            $app->flash('success', $lang->t('admin|ban_add', $data['value']));
            $app->redirect(ADMIN_URL . 'ban');
            
        });
        
        $app->get('/delete/:id', 'validateUser', function ($id) use ($app) {

            global $lang;
            
            $ban = new Banlist();
            $value = $ban->deleteFromList($id);
            
            $app->flash('success', $lang->t('admin|ban_remove', $value));
            $app->redirect(ADMIN_URL . 'ban');
            
        });
        
        $app->get('(/(:page))', 'validateUser', function ($page=1) use ($app) {
            
            global $lang;

            $ban = new Banlist();
            
            $start = getPaginationStart($page);
            $count = $ban->countBanList();
            $number_of_pages = ceil($count/LIMIT);
            
            $list = $ban->showBanList($start, LIMIT);
            
            $app->render(ADMIN_THEME . 'banlist.php', 
                    array('lang' => $lang,
                        'list'=>$list, 
                        'number_of_pages'=>$number_of_pages,
                        'current_page'=>$page,
                        'page_name'=>'banlist'));
        });
        
    });
    
    /*
     * Applications group
     * Admin job applications routes
     */
    $app->group('/applications', function () use ($app) {
        
        // show all job applications
        $app->get('(/(:page))', 'validateUser', function ($page=1) use ($app) {

            global $lang;
            
            $a = new Applications();
            $start = getPaginationStart($page);
            $count = $a->countApplications();
            $number_of_pages = ceil($count/LIMIT);
            
            $applications = $a->getApplications($start);
            
            $app->render(ADMIN_THEME . 'applications.php', 
                        array('lang' => $lang,
                            'applications'=>$applications,
                            'number_of_pages'=>$number_of_pages,
                            'current_page'=>$page,
                            'page_name'=>'applications',
                            'count'=>$count));
        }); 
        
        // get job applications
        $app->get('/jobs/:id(/:page)', 'validateUser', function ($id, $page=1) use ($app) {
            
            global $lang;

            $a = new Applications($id);
            $start = getPaginationStart($page);
            $count = $a->countApplications($id);
            $number_of_pages = ceil($count/LIMIT);
            
            $j = new Jobs($id);
            $title = $j->getSeoTitle();
            
            $applications = $a->getApplications($start);
            
            $app->render(ADMIN_THEME . 'applications.job.php', 
                        array('lang' => $lang,
                            'applications'=>$applications,
                            'number_of_pages'=>$number_of_pages,
                            'current_page'=>$page,
                            'page_name'=>'applications',
                            'count'=>$count,
                            'title'=>$title,
                            'id'=>$id));
            
        });
        
    });
    
    $app->group('/subscribers', function () use ($app) {
        
        $app->get('(/(:page))', 'validateUser', function ($page=1) use ($app) {
            
            global $lang;

            $s = new Subscriptions('');
            
            $start = getPaginationStart($page);
            $count = $s->countSubscriptions();
            $number_of_pages = ceil($count/LIMIT);
            
            $users = $s->getAllSubscriptions($start);
            
            $app->render(ADMIN_THEME . 'subscribers.php', 
                            array('lang' => $lang,
                                'users'=>$users, 
                                'number_of_pages'=>$number_of_pages,
                                'current_page'=>$page,
                                'count'=>$count,
                                'page_name'=>'subscribers'));
            
        });
        
        $app->get('/:id/:action/:token', 'validateUser', function ($id, $action, $token) use ($app) {

            global $lang;
            
            $s = new Subscriptions('');
            $user = $s->getUserSubscription($id, $token);
            
            if (isset($user)) {
                switch ($action) {
                    case 'approve':
                        $s->updateSubscription($id, ACTIVE);
                        $app->flash('success', $lang->t('admin|subscribe_confirm'));
                        break;
                    case 'deactivate':
                        $s->updateSubscription($id, INACTIVE);
                        $app->flash('success', $lang->t('admin|subscribe_deactivate'));
                        break;
                    case 'delete':
                        $s->deleteSubscription($id, $token);
                        $app->flash('success', $lang->t('admin|subscribe_delete'));
                        break;
                }
            }
            $app->redirect(ADMIN_URL . 'subscribers');
        
        });
        
    });
    
});