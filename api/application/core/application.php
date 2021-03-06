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

class Application
{
	// Start Timely API.
	public function __construct()
	{
		// Create database connection
        try {
            $this->db = new Database();
        } catch (PDOException $e) {
            echo json_encode(array(
                "error" => true,
                "msg" => $e
            ));
        }
	}
}
