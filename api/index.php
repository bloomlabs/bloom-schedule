<?php
/**
 * Bloom Labs, Inc.
 * Meeting Room Allocation System - API v1
 *
 * Distribution, modification or use of this source code without
 * authors permission is strictly forbidden under any circumstance.
 * By using this software you agree to our terms of use and service.
 *
 * @abstract    Meeting Room Allocation System API
 * @author      Damian Worsdell <damian@djw.net.au, damian@bloom.org.au>
 * @copyright   Copyright (C) 2015, Damian Worsdell and Bloom Labs, Inc.
 */

// Define our Namespace
namespace Bloom\MeetingSpace\API;
use Bloom\MeetingSpace\API\Model\Booking as Booking;

// Auto-load the classes via Composer's PSR-4 autoloader
require 'vendor/autoload.php';

// Configure log writer
$config['app']['log.writer'] = new \Flynsarmy\SlimMonolog\Log\MonologWriter(array(
    'handlers' => array(
        new \Monolog\Handler\StreamHandler('data/logs/' . date('Y-m-d') . '.log'),
    ),
));

// Start Slim
$app = new \Slim\Slim($config['app']);

// Start log writer
$log = $app->getLog();

// Set response headers
$app->response->headers->set('Content-Type', 'application/json;charset=utf-8');
$app->etag(md5(time()));

// Define path & URL
$req = $app->request;
define('ROOT', $req->getPath());
define('URL', $req->getUrl());

// Bookings
$app->group('/booking', function () use ($app, $log) {

    // Returns the details of the booking an id of :id
    $app->get("/:id", function($id) use($app, $log) {
        Booking::get($id, $app);
    });

});

// Statistics
$app->group('/statistics', function () use ($app, $log) {
    
    // TBD
    
});

// 404 - Not Found
$app->notFound(function () use ($app, $log) {
    $app->response->setStatus(404);
    echo json_encode(array(
        "error" => true,
        "content" => "404 - Not found"
    ));
});

// 500 - System Error
$app->error(function (\Exception $e) use ($app, $log) {
    $app->response->setStatus(500);
    echo json_encode(array(
        "error" => true,
        "content" => $e
    ));
    $log->error($e->getMessage());
});

// Generate.
$app->run();