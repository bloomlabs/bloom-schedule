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
 *
 * http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection
 */

// Define our Namespace
namespace Bloom\MeetingSpace\API\Core;

class Database
{
    private static $factory;
    private $database;

    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new Database();
        }
        return self::$factory;
    }

    public function getConnection() {
        if (!$this->database) {
            try {
    			$options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);
    			$this->database = new \PDO(
    				Config::get('DB_TYPE') . ':host=' . Config::get('DB_HOST') . ';dbname=' .
    				Config::get('DB_NAME') . ';port=' . Config::get('DB_PORT') . ';charset=' . Config::get('DB_CHARSET'),
    				Config::get('DB_USER'), Config::get('DB_PASS'), $options
    			);
            } catch (\PDOException $e) {
                error_log($e->getMessage());
            }
		}
		return $this->database;
    }
}
