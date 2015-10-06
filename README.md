# Bloom Schedule

### About
Bloom Schedule (working name) is a simple PHP-based web app designed to be used as an easy way for members and staff to create, modify and remove bookings for the two meeting rooms currently residing in the Bloom Lab. It's split into two seperate components; an API for data manipulation and a web front-end.

### Goals
Eventually the goal is to have a screen either mounted on the wall or placed near the meeting rooms allowing Bloom Lab members and staff to identify current and scheduled meetings, their duration and if the room is free or not. Users can then proceed to a web page on their personal devices to create, modify or remove their own bookings.

---

## Web App
To be written.

## Dashboard
To be written.

## API
The API is written as a Web 2.0 REST-style API.

### Bookings
`GET -> /booking/:id` - Return the details of the booking an id of :id
```json
Example with :id as 1

{
  "category": "booking",
  "type": "booking_details",
  "content": {
	"booking_id": "1",
	"booking_title": "My cool booking!",
	"booking_author": "John Appleseed"
  }
}
```

... more to come.

### Statistics
`GET -> /statistics/bookings` - Return total amount of bookings managed by the system
```json
{
  "category": "statistics",
  "type": "bookings",
  "content": {
	"total_results": "1"
  }
}
```

... more to come.

### Other API details

#### Database connection
We've formed a database connection in `/core/database.php` using the newer [PDO methodology](http://php.net/manual/en/book.pdo.php). It's mostly self-explanatory in the classes that have already been created, but if you'd like to explore further into database queries feel free to research-up!

Below is a query that would fetch the entire `bookings` table as an array.
```php
// Create MySQL database connection
$database = Database::getFactory()->getConnection();

// Create & prepare our SQL ready to execute
$sql = "SELECT * FROM bookings";
$query = $database->prepare($sql);

// Execute our query
$query->execute();

// Fetch the result as an array
$query->fetchAll()
```

---

### Contributing
Feel free to take a look at CONTRIBUTORS.md for some guidelines on contributing.

### License
Copyright 2015 © [Bloom Labs, Inc.](http://bloom.org.au/) & [Damian J Worsdell](http://djw.net.au/)
> Distribution, modification or use of this source code without<br />permission from Bloom Labs, Inc. It is strictly forbidden under any<br />circumstance. By using it you agree to the terms of use and service.

<br />[![Bloom Labs logo](http://djw.net.au/bloom/Bloom-transparent-1520x813.png)](http://bloom.org.au/)