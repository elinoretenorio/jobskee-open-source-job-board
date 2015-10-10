About
-----
Jobskee is an open source job board with minimal configuration and relatively small footprint.

Author
------
Elinore Tenorio (elinore.tenorio@gmail.com)  
Manila, Philippines

Stacks used
-----------

* Slim Microframework
* RedBeanPHP
* Bootstrap 3 UI
* PHPMailer
* Markdown
* etc.

Requirements
------------
* PHP 5.3 and above
* MySQL
* mod_rewrite enabled

Installation
------------
1. Export sql file
2. Update admin table with your desired username and password (sha1)
3. Upload the files
4. Update config.php with your settings
5. Change file permission of /assets/images and /assets/attachments to 777
6. Check that all .htaccess files were uploaded

Default admin login info: 
Email: admin@example.com
Password: admin

Installation Notes
------------------

### Enable PHP5.3+ using .htaccess

Some old hosting providers still use PHP5.2 version, note that Jobskee will not run on this old version.

In order to use PHP5.3+, you can edit .htaccess file in the root folder and uncomment (remove the pound sign at the beginning of) this line:

﻿`AddType application/x-httpd-php53 .php`

### Importing jobskee.sql

When you download Jobskee, you will find a database file included that you need to import to a MySQL database.

Before importing however, you can edit the file to update several things:

ADMIN ACCOUNT

You can look for this line in the .sql file

﻿`INSERT INTO admin (id, email, password) VALUES
(1, 'admin@example.com', 'd033e22ae348aeb5660fc2140aec35850c4da997')`;

﻿and change it with the values you want:

﻿`INSERT INTO admin (id, email, password) VALUES
(1, 'your desired admin email address', sha1('your desired admin password'))`;

You can also customize the default values for Categories and Cities with the values you want before importing jobskee.sql to your own database.

### Setting up your Jobskee job board

After downloading Jobskee﻿ and have setup your database and correct folder permission on `assets/attachments` and `assets/images`, you can now setup your job board by opening the `config.php` file found in the root folder.

I'd like to mention some important values in the `config.php` that you need to set in order to successfully run your job board:

APP_MODE - currently defaulted to 'development'. You need to set this to 'production' when your site is in production mode as it affects several other configuration (i.e. database, debug, etc.)

APP_THEME - currently set to 'default'. This is the default theme used by Jobskee. If you would like to customize this theme, it is recommended that you copy `/views/default` to your new theme (i.e. `/views/my_theme`) and set APP_THEME to 'my_theme'. This will ensure that you can go back to the default theme, should your theme customization produce error that you cannot recover.

SMTP SETTINGS - the default SMTP settings is Gmail friendly and should work right away when you provide your correct Gmail information. For other settings, like using your own hosting's default mail host, you must configure it correctly in order for email notifications to work.

These are the recommended settings:

Using "localhost"

﻿// SMTP SETTINGS  
define('SMTP_ENABLED', true);  
define('SMTP_AUTH', false);  
define('SMTP_URL', 'localhost');  
define('SMTP_USER', 'email@example.com');  
define('SMTP_PASS', '');  
define('SMTP_PORT', 25);  
define('SMTP_SECURE', '');  

and using Gmail

// SMTP SETTINGS  
define('SMTP_ENABLED', true);  
define('SMTP_AUTH', true);  
define('SMTP_URL', 'smtp.gmail.com');  
define('SMTP_USER', 'email@gmail.com');  
define('SMTP_PASS', 'gmail password);  
define('SMTP_PORT', 465);  
define('SMTP_SECURE', 'ssl');  

APPLICATION URL PATHS - as commented in the file, you need to provide your full URL including the trailing slashes.

SHARETHIS_PUBID - in order to enable the social media sharing for the jobs, you need to register a Publication ID at www.sharethis.com

CRON_TOKEN - this is used for running cron job to expire jobs. Provide a unique token that you can use in order to expire jobs using the path: `/cron/jobs/expire/:cron_token`

GA_TRACKING - get insights to your job board by adding a Google Analytics tracking ID here.

### Switch Language

Comment out Lines 15 and 16 and uncomment Lines 19 and 20 to switch from English to French translation