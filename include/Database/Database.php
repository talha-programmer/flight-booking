<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "flight_booking_system");


class Database {
    protected static $mysqli = null;
    public function __construct() {
        self::$mysqli  = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        if(self::$mysqli->errno) {     // Checking for errors in database connection
            die("Database connection failed: "  . mysqli_connect_error(). "(" . mysqli_connect_errno() . ")");
        }
    }


}
