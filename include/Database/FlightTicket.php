<?php
require_once ('Database.php');

class FlightTicket extends Database
{
    public function setFlightTicket(array $data) {
        $user_id = $data['user_id'];
        $airline = $data['airline'];
        $departure_date = $data['departure_date'];
        $departure_time = $data['departure_time'];
        $departure = $data['departure'];
        $destination = $data['destination'];
        $is_direct = $data['is_direct'];
        $total_price = $data['total_price'];
        $total_passengers = $data['total_passengers'];

        $query = "INSERT INTO flight_ticket ";
        $query .= "(user_id, airline, departure, destination, departure_date, departure_time, is_direct, total_price, total_passengers) ";
        $query .= "VALUES ($user_id, '$airline', '$departure', '$destination', '$departure_date', '$departure_time', '$is_direct', '$total_price', $total_passengers) ";
        if($result = self::$mysqli->query($query)){
            return true;
        }
        else{
            return false;
        }

    }

    public function getTickets($user_id){
        $query = "SELECT * from flight_ticket where user_id = $user_id";
        $result = self::$mysqli->query($query);
        if($result) {
            return $result;
        }
        else{
            return false;
        }
    }
}