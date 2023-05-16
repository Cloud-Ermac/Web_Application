<?php
/**
 * @author Olayinka Hassan
 *
 */
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
define('BASE_PATH','/WebApp/coursework/api');
define ('DATABASE','/db/chiplay.sqlite');
include 'BadRequest.php';
include 'exceptionhandler.php';
set_exception_handler('exceptionHandler');
// include and register the autoloader
require "vendor/autoload.php";
// secret key for the JWT
define('SECRET', "dJ~qjizIKJ>>r>}@NY)J6lU+/uBZ:Q");

