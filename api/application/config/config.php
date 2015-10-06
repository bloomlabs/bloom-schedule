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

// Configure error reporting
error_reporting(E_ALL);
ini_set("display_errors", 0);

// Configure the db connection
return array(
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => '',
    'DB_USER' => '',
    'DB_PASS' => '',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8'
);
