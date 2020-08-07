<?php
session_start();
require_once ('../include/BusinessLogic/BookFlight.php');
require_once ('../include/Database/FlightTicket.php');
if(isset($_POST['submit'])){
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $check_in_date = date("Y-m-d", strtotime($check_in_date));
    $check_out_date = date("Y-m-d", strtotime($check_out_date));
    $book_flight = new BookFlight();
    $flights_data = null;
    if($response =  $book_flight->getFlights($flying_from,$flying_to,$check_in_date,$check_out_date)){
        $flights_data = $response;
    }else{
        header("location: book_flights.php");
        exit();
    }
}
if(isset($_POST['book_now'])) {
    $confirm_flight = false;
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message_error'] = 'You must be logged in to continue';
        header("location: login.php");
        exit();
    }
    else {
        $airline = $_POST['airline'];
        $departure_date = $_POST['departure_date'];
        $departure_time = $_POST['departure_time'];
        $departure = $_POST['departure'];
        $destination = $_POST['destination'];
        $is_direct = $_POST['is_direct'];
        $min_price = $_POST['min_price'];
        $currency_symbol = $_POST['currency_symbol'];
        $confirm_flight = true;
    }
}
if(isset($_POST['confirm_booking'])){
    $db = new FlightTicket();
    $data = array();
    $data['user_id'] = $_SESSION['user_id'];
    $data['airline'] = $_POST['airline'];
    $data['departure_date'] = $_POST['departure_date'];
    $data['departure_time'] = $_POST['departure_time'];
    $data['departure'] = $_POST['departure'];
    $data['destination'] = $_POST['destination'];
    $data['is_direct'] = $_POST['direct_flight'];
    $data['total_price'] =$_POST['currency_symbol'] .' '. $_POST['total_price'];
    $data['total_passengers'] = $_POST['total_passengers'];
    if($db->setFlightTicket($data)){
        $_SESSION['message_success'] = "Ticket Confirmed successfully!";
        header("location: dashboard.php");
        exit();
    }else{
        $_SESSION['message_error'] = "Some error occurred while booking!";
        header("location: book_flight.php");
        exit();
    }
}
?>
<?php require_once ('header.php');?>
<?php if (isset($flights_data)):?>
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="font-weight-bold">
                    <tr>
                        <td>Airline</td>
                        <td>Departure Date</td>
                        <td>Departure Time</td>
                        <td>Departure</td>
                        <td>Destination</td>
                        <td>Direct</td>
                        <td>Min Price</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flights_data as $flight): ?>
                    <form action="search_flights.php" method="post">
                        <tr>
                            <td>
                                <input type="hidden" name="airline" value="<?=$flight['airline']?>">
                                <?=$flight['airline']?>
                            </td>
                            <td>
                                <input type="hidden" name="departure_date" value="<?=$flight['departure_date']?>">
                                <?=$flight['departure_date']?>
                            </td>
                            <td>
                                <input type="hidden" name="departure_time" value="<?=$flight['departure_time']?>">
                                <?=$flight['departure_time']?>
                            </td>
                            <td>
                                <input type="hidden" name="departure" value="<?=$flight['origin']?>">
                                <?=$flight['origin']?>
                            </td>
                            <td>
                                <input type="hidden" name="destination" value="<?=$flight['destination']?>">
                                <?=$flight['destination']?>
                            </td>
                            <td>
                                <input type="hidden" name="is_direct" value="<?=$flight['is_direct']?>">
                                <?=$flight['is_direct']? "Yes": "No" ?>
                            </td>
                            <td>
                                <input type="hidden" name="min_price" value="<?=$flight['min_price']?>">
                                <input type="hidden" name="currency_symbol" value="<?=$flight['currency_symbol']?>">
                                <?php echo $flight['currency_symbol']. ' '. $flight['min_price']?>
                            </td>
                            <td>
                                <input class="btn btn-primary" type="submit" name="book_now" value="Book Now">
                            </td>
                        </tr>
                    </form>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif;?>
<?php if(isset($confirm_flight) && $confirm_flight == true):?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 ml-auto mr-auto form_with_shadow">
            <h3>Confirm Your Flight Booking</h3>

            <form method="post" id="confirm-booking-form" action="search_flights.php">
                <div class="form-group">
                    <label for="total-passengers">Total Passengers</label>
                    <input type="number" name="total_passengers" value="1" class="form-control" id="total-passengers">
                </div>
                <div class="form-group">
                    <label for="total-price">Total Price</label>
                    <input type="number" name="total_price" class="form-control" id="total-price" value="<?=$min_price?>" disabled>
                </div>

                <div class="form-group">
                    <label for="airline">Airline</label>
                    <input type="text" name="airline" class="form-control" id="airline" value="<?=$airline?>" disabled>
                </div>
                <div class="form-group">
                    <label for="departure-date">Departure Date</label>
                    <input type="text" name="departure_date" class="form-control" id="departure-date" value="<?=$departure_date?>" disabled>
                </div>
                <div class="form-group">
                    <label for="departure-time">Departure Time</label>
                    <input type="text" name="departure_time" class="form-control" id="departure-time" value="<?=$departure_time?>" disabled>
                </div>
                <div class="form-group">
                    <label for="departure">Departure From</label>
                    <input type="text" name="departure" class="form-control" id="departure" value="<?=$departure?>" disabled>
                </div>

                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" class="form-control" id="destination" value="<?=$destination?>" disabled>
                </div>
                <div class="form-group">
                    <label for="direct-flight">Direct Flight</label>
                    <input type="text" name="direct_flight" class="form-control" id="direct-flight" value="<?=$is_direct? "Yes": "No"?>" disabled>
                    <input type="hidden" name="currency_symbol" value="<?=$currency_symbol?>">
                </div>
                <input type="submit" id="confirm-booking" name="confirm_booking" class="btn btn-primary" value="Confirm Booking">
            </form>
        </div>
    </div>
</div>
<?php endif;?>

<script type="text/javascript">
$(document).ready(function (){
    $("#total-passengers").change(function (){
        var passengers = $("#total-passengers").val();
        var price = <?php echo $min_price?>;
        price *= passengers;
        $("#total-price").val(price);
    });

    $("#confirm-booking").click(function (){
        $("input").removeAttr('disabled');
    });
});
</script>
<?php require_once ('footer.php');
