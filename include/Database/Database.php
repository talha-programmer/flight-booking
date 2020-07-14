<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "flight_booking_system");


class Database
{
    protected static $connection;
    public function __construct()
    {
        self::$connection  = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if(mysqli_connect_errno())      // Checking for errors in database connection
        {
            die("Database connection failed: "  . mysqli_connect_error(). "(" . mysqli_connect_errno() . ")");
        }
    }

}
