<?php session_start();?>
<?php require_once("header.php"); ?>

<div id="section_1">
    <div class="section_1_overlay">
        <div class="container" style="padding: 160px 20px 150px 20px;">
            <div class="row">
                <div class="col-md-8" style="margin-bottom: 10px;">
                    <h1>Book all types of international flights through our website</h1>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn_book_now">Book Now</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="section_2" style="margin: 80px 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-3  shadow_box">
                <h3>Our Expertise</h3>
                <p>We are expert in providing efficient services regarding flight booking</p>
            </div>
            <div class="col-md-3 offset-1 shadow_box">
                <h3>Book Flights</h3>
                <p>Book all international flights by creating account on our website.
                    You can also check all flight schedules and fares without signing up</p>
            </div>
            <div class="col-md-3 offset-1 shadow_box">
                <h3>Online Payment</h3>
                <p>Pay through online payment services and download your computerized ticket on the spot</p>
            </div>
        </div>
    </div>

</div>

<div id="section_3" style="padding: 60px 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin: 10px 0px 10px 0px;">
                <h2>Register now for free to access all of our services</h2>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary register_button" href="register.php">Register Now</a>
            </div>
        </div>
    </div>

</div>

<div class="testimonial">

    <div class="testimonial-overlay">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div id="carousel-testimonial" class="carousel slide" data-ride= "carousel">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-testimonial" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-testimonial" data-slide-to="1"></li>
                            <li data-target="#carousel-testimonial" data-slide-to="2"></li>
                        </ol>

                        <!-- wrapper for slides -->
                        <div class="carousel-inner">

                            <!-- Item 1-->
                            <div class="carousel-item active text-center">
                                <div class="testimonial-caption">
                                    <h2>Ahmed Khan</h2>
                                    <p>I am very happy and satisfied with the service of FlightBooking. They are efficient
                                        in quick reservation of flight tickets. Also, you don't need to worry about payments
                                        as they are offering very efficient online payment system.</p>
                                </div>
                            </div>

                            <!-- Item 2-->
                            <div class="carousel-item text-center">

                                <div class="testimonial-caption">
                                    <h2>Junaid Tariq</h2>
                                    <p>FlightBooking offers very good services for the booking of international flights.
                                        Also, their customer support service department is very efficient. I would give 9 out
                                       of 10 rating to FlightBooking</p>
                                </div>
                            </div>

                            <!-- Item 3-->
                            <div class="carousel-item text-center">

                                <div class="testimonial-caption">

                                    <h2>Muhammad Imran</h2>
                                    <p>FlightBooking always helps you when you are in hurry to travel somewhere. They offer
                                       very quick reservation of tickets of all airlines.</p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once("footer.php"); ?>