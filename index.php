<?php

// Application Entry Point
// All Requests will be sent here via .htaccess (apache)
// TODO: How to do this with IIS.

// Require the composer autoload file.
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig()
));

// Configure Twig
$app->view->parserOptions = array('debug' => true);
$view->parserExtentions = array(new \Slim\Views\TwigExtension());

// Define Application Routes
$app->get('/', function(){
	echo "Hello, testing!";
});

$app->run();