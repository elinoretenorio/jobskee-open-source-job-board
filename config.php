<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 */

// INITIATE SESSION
session_start();
ini_set('default_charset', 'utf-8');

// ENGLISH TRANSLATION
define('APP_LANG', 'en');
setlocale(LC_ALL, 'en_EN');

// FRENCH TRANSLATION
// define('APP_LANG', 'fr');
// setlocale(LC_ALL, 'fr_FR');

// AUTO LOAD MODELS
include 'models/helpers.php';
include 'models/class.phpmailer.php';
include 'models/class.smtp.php';
include 'models/rb.php';
spl_autoload_register(function ($class) {
	if (file_exists("models/{$class}.php")) { include "models/{$class}.php"; }	
});

// LOAD TRANSLATION
$lang = new Translate();

// APPLICATION SETTINGS
define('APP_NAME', $lang->t('app|name'));
define('APP_DESC', $lang->t('app|desc'));
define('APP_AUTHOR', 'Elinore Tenorio (elinore.tenorio@gmail.com)');
define('APP_MODE', 'development'); // set to 'production' if site is live, affects RedBean not being frozen if not in correct mode
define('APP_THEME', 'default'); // set to the theme folder name you are using, found in /views directory

// TIMEZONE
date_default_timezone_set($lang->t('app|timezone'));

/*
 ****************************************************
 * USER SETTINGS
 * You are free to modify the settings below
 * to suit your needs
 ****************************************************
 */

// SMTP SETTINGS
define('SMTP_ENABLED', true);
define('SMTP_AUTH', true);
define('SMTP_URL', 'smtp.gmail.com');
define('SMTP_USER', 'username@gmail.com');
define('SMTP_PASS', 'password');
define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl');

// APPLICATION URL PATHS
define('BASE_URL','http://jobskee.local:10088/'); // always include the trailing slash at the end

// DATABASE SETTINGS
define('DB_HOST', 'localhost');
define('DB_NAME', 'jobskee');
define('DB_USER', 'root');
define('DB_PASS', '');

// GOOGLE ANALYTICS TRACKING
define('GA_TRACKING', '');

// APP SETTINGS CONSTANTS
define('LOGO_H', 200); // logo height
define('LOGO_W', 200); // logo width
define('LIMIT', 20); // number of jobs to display per page
define('HOME_LIMIT', 5); // number of jobs to display per category on the homepage
define('EXPIRE_JOBS', 30); // days to expire jobs
define('CRON_TOKEN', 'ioYgaCEfCEXQtzP2'); // token to verify cron job execution
define('ALLOW_JOB_POST', 1); // set (1) to allow job posting and (0) to turn off

/*
 ****************************************************
 * DEFAULT CORE SETTINGS
 * Modify only if you know what you are doing
 ****************************************************
 */

// CORE APPLICATION PATH
define('APP_PATH', str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('ADMIN_URL', BASE_URL . 'admin/'); // always include the trailing slash at the end

// CORE CONSTANTS
define('ACTIVE', 1);
define('INACTIVE', 0);
define('CSV_FIELDS', 10);

// CORE APPLICATION URLS
define('ASSET_URL', BASE_URL . 'assets/');
define('ATTACHMENT_PATH', 'assets/attachments/');
define('IMAGE_PATH', 'assets/images/');
define('LOGIN_URL', ADMIN_URL . 'login');

// MVC PATHS
define('MODEL_PATH', 'models/');
define('VIEWS_PATH', 'views');
define('CONTROLLER_PATH','controllers/');

// CORE THEME SETTINGS
define('THEME_PATH', APP_THEME .'/');
define('THEME_ASSETS', BASE_URL . VIEWS_PATH .'/'. THEME_PATH .'assets/');

// ADMIN THEME SETTINGS
define('ADMIN_THEME', 'admin/');
define('ADMIN_ASSETS', BASE_URL . VIEWS_PATH .'/'. ADMIN_THEME . 'assets/');

// REDBEAN ORM CONFIG
R::setup("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
if (APP_MODE == 'production') {
    R::freeze();
	$debug = false;
} else {
	$debug = true;
}

// SLIM MICROFRAMEWORK
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// SLIM CSRF GUARD
require 'Slim/Extras/Middleware/CsrfGuard.php';

$app = new \Slim\Slim(array('mode'=>APP_MODE, 'templates.path'=>VIEWS_PATH, 'debug'=>$debug));
$app->add(new \Slim\Extras\Middleware\CsrfGuard());
$app->notFound(function () use ($app) {
    $app->flash('danger', 'The page you are looking for could not be found.');
    $url = (userIsValid()) ? ADMIN_MANAGE : BASE_URL;
    $app->redirect($url);
});

$app->flashKeep();