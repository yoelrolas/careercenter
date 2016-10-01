<?php
$dbpconnect = TRUE;

//MY_CONSTANT
define('MY_BASEURL', 'http://localhost/cdc');
define('MY_DBHOST', 'localhost');
define('MY_DBUSER', 'root');
define('MY_DBPASS', '');
define('MY_DBNAME', 'cdc');
define('MY_DBPCONNECT', $dbpconnect);
define('MY_ASSETPATH', './assets');
define('MY_ASSETURL', MY_BASEURL.'/assets');
define('MY_IMAGEPATH', './assets/media/image/');
define('MY_IMAGEURL', MY_ASSETURL.'/media/image/');
define('MY_UPLOADPATH', './assets/media/upload/');
define('MY_UPLOADURL', MY_ASSETURL.'/media/upload/');
define('SYSTEMUSERNAME', 'admin');

define('FRONTENDPATH', './assets/frontend');
define('FRONTENDVIEWPATH', FRONTENDPATH.'/view');