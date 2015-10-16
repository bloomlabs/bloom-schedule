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
use Bloom\Schedule\API\Core\Database as Database;

class Booking
{
    // Returns the details of all current and future bookings
    public static function all($app) {
        $Database = Database::getFactory()->getConnection();
        
        $sql = "SELECT *
                FROM   bookings
                WHERE  `booking_start` > CURRENT_TIMESTAMP";
        $query = $Database->prepare($sql);
        
        $query->execute();
        
        $result = $query->fetchAll();
        
        echo json_encode(array(
            "category" => "bookings",
            "type" => "all",
            "content" => $result
        ));
    }

    // Returns the details of the next bookings in an array
    public static function next($app, $room) {
        $Database = Database::getFactory()->getConnection();
        
        $sql = "SELECT *
                FROM   bookings
                WHERE  `booking_start` > CURRENT_TIMESTAMP
                       AND `booking_room` = :room
                LIMIT  1";
        $query = $Database->prepare($sql);
        
        $room = filter_var(filter_var($room, FILTER_SANITIZE_NUMBER_INT), FILTER_VALIDATE_INT);
        $query->execute(array(':room' => $room));
        
        $result = $query->fetch();
        
        echo json_encode(array(
            "category" => "bookings",
            "type" => "next",
            "room" => $room,
            "content" => $result
        ));
    }
    
    // Returns the details of the booking an id of :id
    public static function get($app, $id) {
        $Database = Database::getFactory()->getConnection();
        
        $sql = "SELECT *
                FROM   bookings
                WHERE  ( booking_id = :id )
                LIMIT  1";
        $query = $Database->prepare($sql);
        
        $id = filter_var(filter_var($id, FILTER_SANITIZE_NUMBER_INT), FILTER_VALIDATE_INT);
        $query->execute(array(':id' => $id));
        
        $result = $query->fetch();
        
        echo json_encode(array(
            "category" => "bookings",
            "type" => "booking_details",
            "content" => $result
        ));
    }
    
    // Create booking & return success or failure
    public static function create($app, $details) {
        $Database = Database::getFactory()->getConnection();
        
        $sql = "INSERT INTO `bookings` (
                            `booking_id`,
                            `booking_title`,
                            `booking_room`,
                            `booking_creator`,
                            `booking_start`,
                            `booking_end`,
                            `booking_notes`,
                            `booking_attendees`,
                            `booking_guests`)
                VALUES      ( NULL,
                             ':title',
                             ':room',
                             ':creator',
                             ':from',
                             ':to',
                             ':notes',
                             ':attendees',
                             ':guests' );";
        $query = $Database->prepare($sql);
        
        $title      = $details['title'];
        $room       = $details['room'];
        $creator    = $details['creator'];
        $from       = $details['from'];
        $to         = $details['to'];
        $notes      = $details['notes'];
        $attendees  = $details['attendees'];
        $guests     = $details['guests'];
        
        $query->execute(array(
        	':title'	 => $title,
        	':room' 	 => $room,
        	':creator' 	 => $creator,
        	':from' 	 => $from,
        	':to' 		 => $to,
        	':notes' 	 => $notes,
        	':attendees' => $attendees,
        	':guests' 	 => $guests
        ));
        
        // TODO: If success then true, else false...
        echo json_encode(array(
        	"category" => "bookings",
        	"type" => "booking_create",
        	"success" => true
        ));
    }
}
