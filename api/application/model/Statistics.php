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
namespace Bloom\Schedule\API\Model;
use Bloom\Schedule\API\Database as Database;

class Statistics
{
    // Return total amount of bookings managed by the system
    public static function bookings() {
        $database = Database::getFactory()->getConnection();

        $sql = "SELECT * FROM bookings";
        $query = $database->prepare($sql);

        $query->execute();

        echo json_encode(array(
            "category" => "statistics",
            "type" => "bookings",
            "content" => $query->rowCount()
        ));
    }
}
