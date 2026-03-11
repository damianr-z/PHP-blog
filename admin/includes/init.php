<?php 

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("SITE_ROOT") ? null : define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS . 'gallery');
// defined('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'gallery'); once uploaded to public domain


defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT.DS.'admin'.DS.'images');




require_once(__DIR__ . DS . "functions.php");
require_once(__DIR__ . DS . "new_config.php");
require_once(__DIR__ . DS . "database.php");
require_once(__DIR__ . DS . "db_object.php");
require_once(__DIR__ . DS . "user.php");
require_once(__DIR__ . DS . "photo.php");
require_once(__DIR__ . DS . "session.php");
require_once(__DIR__ . DS . "paginate.php");

?>