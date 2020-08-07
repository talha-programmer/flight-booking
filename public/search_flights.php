<?php
require_once ('../include/BusinessLogic/BookFlight.php');
if(isset($_POST['submit'])){
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $check_in_date = date("Y-m-d", strtotime($check_in_date));
    $check_out_date = date("Y-m-d", strtotime($check_out_date));

    $book_flight = new BookFlight();
    $response =  $book_flight->getFlights($flying_from,$flying_to,$check_in_date,$check_out_date);
    $response = json_decode($response, true);
    var_dump($response);

}