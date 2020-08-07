<?php
require_once('../include/BusinessLogic/BookFlight.php');
$book_flight = new BookFlight();
//$_POST['query'] = "islam";
try{
    if (isset($_POST['query'])) {
        $query = $_POST['query'];
        if ($places = $book_flight->getPlaces($query)) {
            echo json_encode($places);
        }
    }
}catch(Exception $exception){
    echo $exception->getMessage();
}