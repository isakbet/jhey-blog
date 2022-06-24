<?php
// Turn on/off error reporting
error_reporting(-1); // 0 = off

// Start session
session_start();

/** 
 * The ROOT_PATH leads to the root directory for all code, 
 * in this case this leads 'my-page-3' folder.
 * 
 * __DIR__ is a built-in constant that returns the directory/folder path of the file
 * Read more about constants: https://www.php.net/manual/en/language.constants.predefined.php

 *
 * ROOT_PATH is defined as a consntat
 * Read more about constants: https://www.php.net/manual/en/function.define
 */
define('ROOT_PATH',  __DIR__ . '/../'); // path to project folder
define('SRC_PATH', __DIR__ . '../');          // path to "src"-folder
define('CSS_PATH', '../public/assets/bootstrap/css/');          // path to "css"-folder
define('IMG_PATH', '../public/assets/img/');          // path to "img"-folder

// Examine the dynamic paths
// print_r(ROOT_PATH);
// print_r(SRC_PATH);
// print_r(__DIR__);


// Include functions and classes
require(SRC_PATH . '/dbconnect.php');

// Follow the same paatern when creating other classes and functions :)
