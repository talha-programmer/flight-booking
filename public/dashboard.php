<?php
session_start();
require_once ('../include/Database/FlightTicket.php');
$db = new FlightTicket();
$tickets = $db->getTickets($_SESSION['user_id']);

require_once ('header.php');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Booked Tickets</h3>
            <table class="table">
                <thead class="font-weight-bold">
                <tr>
                    <td>Airline</td>
                    <td>Departure</td>
                    <td>Destination</td>
                    <td>Departure Date</td>
                    <td>Departure Time</td>
                    <td>Direct</td>
                    <td>Passengers</td>
                    <td>Price</td>
                </tr>
                </thead>
                <tbody>
                <?php while ($ticket = mysqli_fetch_assoc($tickets)): ?>
                    <tr>
                    <td><?=$ticket['airline']?></td>
                    <td><?=$ticket['departure']?></td>
                    <td><?=$ticket['destination']?></td>
                    <td><?=$ticket['departure_date']?></td>
                    <td><?=$ticket['departure_time']?></td>
                    <td><?=$ticket['is_direct']?></td>
                    <td><?=$ticket['total_passengers']?></td>
                    <td><?=$ticket['total_price']?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once ('footer.php');?>
