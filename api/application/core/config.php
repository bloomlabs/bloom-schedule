<?php
/**
 * Bloom Schedule
 * API - v1
 *
 * Distribution, modification or use of this source code without
 * authors permission is strictly forbidden under any circumstance.
 * By using this software you agree to our terms of use and service.
 *
 * @abstract    Bloom Schedule - API
 * @author      Damian Worsdell <damian@djw.net.au>
 * @copyright   Copyright (C) 2015, Damian Worsdell and Bloom Labs, Inc.
 */

// Define our Namespace
namespace Bloom\Schedule\API\Core;

class Config
{
    public static $config;

    public static function get($key)
    {
        if (!self::$config) {
            $config_file = 'application/config/config.php';

            if (!file_exists($config_file)) {
                return false;
            }

            self::$config = require $config_file;
        }

        return self::$config[$key];
    }
}
