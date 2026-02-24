<?php 


function classAutoloader($class) {
$class = strtolower($class);

// Ensure DS exists even if this file is included standalone.
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// Load class files from the admin includes directory (not the public /includes folder).
$base_dir = defined("INCLUDES_PATH") ? INCLUDES_PATH : __DIR__;
$the_path = $base_dir . DS . "{$class}.php";

    if (is_file($the_path) && !class_exists($class)) {
        require_once $the_path;
    } else {
        die("This file named {$class}.php was not found..."); 
    }
}

spl_autoload_register('classAutoloader');

function redirect($location) {
    header("Location: {$location}");
    exit;
}

?>