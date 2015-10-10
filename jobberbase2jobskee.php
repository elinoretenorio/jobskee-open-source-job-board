<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * jobberBase to Jobskee DB converter
 * - requires that both databases are in the same server
 * - this script will migrate categories, cities, jobs and pages
 */

// DB CONFIG - MODIFY THIS
$jobberbase = array('db_host' => 'localhost',
					'db_name' => 'jobberbase',
					'db_user' => 'root',
					'db_pass' => '');

$jobskee = array('db_host' => 'localhost',
					'db_name' => 'jobskee',
					'db_user' => 'root',
					'db_pass' => '');

///////////////////////////
// DO NOT MODIFY BELOW
///////////////////////////

// REDBEAN ORM CONFIG
require_once 'models/rb.php';
R::setup("mysql:host=".$jobskee['db_host'].";dbname=".$jobskee['db_name'], $jobskee['db_user'], $jobskee['db_pass']);

// Setup ID matching
$ids = array();

echo "[". date('Y-m-d H:i:s') ."] Starting jobberBase to Jobskee DB import...<br />";

// Convert Categories
$categs = R::getAll("SELECT * FROM {$jobberbase['db_name']}.categories");
echo "[". date('Y-m-d H:i:s') ."] ----- <br />";
echo "[". date('Y-m-d H:i:s') ."] Starting 'categories' import...<br />";
foreach ($categs as $cat) {
 	$jcat = R::dispense('categories');
	$jcat->name = $cat['name'];
	$jcat->description = $cat['description'];
	$jcat->url = strtolower($cat['var_name']);
	$jcat->sort = $cat['category_order'];
	$ids['categories'][$cat['id']] = R::store($jcat);
	echo "[". date('Y-m-d H:i:s') ."] Importing ". $cat['name'] . " category...done<br />";
}

echo "[". date('Y-m-d H:i:s') ."] Imported ". count($ids['categories']) . " categories...ok!<br />";

// Convert Cities
$cities = R::getAll("SELECT * FROM {$jobberbase['db_name']}.cities");
echo "[". date('Y-m-d H:i:s') ."] ----- <br />";
echo "[". date('Y-m-d H:i:s') ."] Starting 'cities' import...<br />";
foreach ($cities as $city) {
 	$jcity = R::dispense('cities');
	$jcity->name = $city['name'];
	$jcity->description = '';
	$jcity->url = strtolower($city['ascii_name']);
	$jcity->sort = 0;
	$ids['cities'][$city['id']] = R::store($jcity);
	echo "[". date('Y-m-d H:i:s') ."] Importing ". $city['name'] . " city...done<br />";
}

echo "[". date('Y-m-d H:i:s') ."] Imported ". count($ids['cities']) . " cities...ok!<br />";

// Convert Jobs
$jobs = R::getAll("SELECT * FROM {$jobberbase['db_name']}.jobs");
echo "[". date('Y-m-d H:i:s') ."] ----- <br />";
echo "[". date('Y-m-d H:i:s') ."] Starting 'jobs' import...<br />";
foreach ($jobs as $job) {
 	$jjob = R::dispense('jobs');
	$jjob->title = $job['title'];
	$jjob->category = (isset($ids['categories'][$job['category_id']])) ? $ids['categories'][$job['category_id']] : 1;
	$jjob->city = (!is_null($job['city_id'])) ? $ids['cities'][$job['city_id']] : 1;
	$jjob->description = $job['description'];
	$jjob->perks = '';
	$jjob->how_to_apply = ($job['apply_online'] == 1) ? '' : "Send your applications to: {$job['poster_email']}";
	$jjob->company_name = $job['company'];
	$jjob->logo = '';
	$jjob->url = strtolower($job['url']);
	$jjob->email = $job['poster_email'];
	$jjob->is_featured = $job['spotlight'];
	$jjob->token = $job['auth'];
	$jjob->status = $job['is_active'];
	$jjob->created = $job['created_on'];
	$ids['jobs'][$job['id']] = R::store($jjob);
	echo "[". date('Y-m-d H:i:s') ."] Importing ". $job['title'] . " job...done<br />";
}

echo "[". date('Y-m-d H:i:s') ."] Imported ". count($ids['jobs']) . " jobs...ok!<br />";

// Convert Pages
$pages = R::getAll("SELECT * FROM {$jobberbase['db_name']}.pages");
echo "[". date('Y-m-d H:i:s') ."] ----- <br />";
echo "[". date('Y-m-d H:i:s') ."] Starting 'pages' import...<br />";
foreach ($pages as $page) {
 	$jpages = R::dispense('pages');
	$jpages->name = $page['title'];
	$jpages->description = $page['description'];
	$jpages->url = strtolower($page['url']);
	$jpages->content = $page['content'];
	$ids['pages'][$page['id']] = R::store($jpages);
	echo "[". date('Y-m-d H:i:s') ."] Importing ". $page['title'] . " page...done<br />";
}

echo "[". date('Y-m-d H:i:s') ."] Imported ". count($ids['pages']) . " pages...ok!<br />";
echo "[". date('Y-m-d H:i:s') ."] ----- <br />";
echo "[". date('Y-m-d H:i:s') ."] Done.";

echo "<img src=\"http://c.statcounter.com/9473250/0/77fcf0a4/1/\">"; //Jobskee tracker

?>