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
$app->get('/', function() use ($app){
    $app->render('home.twig');
});
$app->group('/user', function() use ($app){
    $app->get('/add', function() use ($app){
        $app->render('userAdd.twig');
    });
    // Handle the form submition
    $app->post('/add', function() use ($app){
        // Add user
    });
});



$app->run();
