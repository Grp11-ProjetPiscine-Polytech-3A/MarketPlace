To activate ModRewrite : 

There are 3 steps to remove index.php.

Make below changes in application/config.php file

$config['base_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/Your Ci folder_name';
$config['index_page'] = '';
$config['uri_protocol'] = 'AUTO';
Make .htaccess file in your root directory using below code

RewriteEngine on
RewriteCond $1 !^(index\.php|resources|robots\.txt)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L,QSA]
Enable the rewrite engine (if not already enabled)

i. First, initiate it with the following command:

a2enmod rewrite
ii. Edit the file /etc/apache2/sites-enabled/000-default

Change all AllowOverride None to AllowOverride All.

Note: In latest version you need to change in /etc/apache2/apache2.conf file

iii. Restart your server with the following command:

sudo /etc/init.d/apache2 restart



Source : https://stackoverflow.com/questions/14783666/codeigniter-htaccess-and-url-rewrite-issues#14807463
