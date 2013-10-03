<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

/**Routing Info*/
$FrontController=Zend_Controller_Front::getInstance();
$Router = $FrontController->getRouter();

$Router->addRoute("login", new Zend_Controller_Router_Route(
                           '/login',
                           array('module' => 'default',
								 'controller' => 'index',
                           		 'action' => 'login'
)));

$Router->addRoute("browseCycles", new Zend_Controller_Router_Route(
							'/browse/cycles/:cyclename',
							array('cyclename' => 'Harley Davidson',
								  'controller' => 'browse',
								  'action' => 'cycle'
)));

$Router->addRoute("viewCycle", new Zend_Controller_Router_Route(
				  		   '/view/:cyclename',
		          		   array('cyclename' => 'Harley Davidson',
				  		   		 'controller' => 'view',
				           		 'action' => 'cycles'
)));


$application->bootstrap()
            ->run();