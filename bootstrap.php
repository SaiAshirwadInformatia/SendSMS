<?php
/**
 *
 * Bootstrapper
 *
 * @abstract Starting point of application
 *
 * @author Rohan Sakhale
 * @copyright saiashirwad.com
 */

/**
 * Define Constants that can be used globally in entire application
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('SAI_SENDSMS_PATH')) {
    define('SAI_SENDSMS_PATH', __DIR__ . DS);
}

/**
 *     Load Third Party Classes
 */
if (file_exists('vendor' . DS . 'autoload.php')) {
    require_once 'vendor/autoload.php';
}
require_once 'src/Autoload.php';
