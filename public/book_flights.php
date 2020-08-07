<?php $using_jquery_ui = true; ?>
<?php require_once ('header.php');?>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="form-header">
                            <h1>Book Your Flight</h1>
                        </div>
                        <form action="search_flights.php" method="post">
                            <div class="form-group">
                                <input id="flying-from" name="flying_from" class="form-control" type="text">
                                <span class="form-label">Flying from</span>
                            </div>
                            <div class="form-group">
                                <input id="flying-to" name="flying_to" class="form-control" type="text">
                                <span class="form-label">Flying to</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="check_in_date" class="form-control" type="date">
                                        <span class="form-label">Check In</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="check_out_date" class="form-control" type="date">
                                        <span class="form-label">Check Out</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn">
                                <button name="submit" class="submit-btn">Check availability</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    $( "#flying-from, #flying-to").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "POST",
                url:"search_places.php",
                data: {"query": request},
                dataType: 'json',
                success: function (data) {
                    var parsed = JSON.parse(data);
                    var responseData = new Array(parsed['Places'].length);
                    for (var i=0; i< parsed['Places'].length; i++){
                        responseData[i] = new Array(2)
                        responseData[i]['label'] = parsed['Places'][i]['PlaceName'] + ", " + parsed['Places'][i]['CountryName'];
                        responseData[i]['value'] =  parsed['Places'][i]['PlaceId'];
                    }
                    response(responseData);

                },
                error: function ( jqXHR,error, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        }
    }, {minLength: 3 });

    $('.form-control').each(function () {
        floatedLabel($(this));
    });

    $('.form-control').on('input', function () {
        floatedLabel($(this));
    });

    function floatedLabel(input) {
        var $field = input.closest('.form-group');
        if (input.val()) {
            $field.addClass('input-not-empty');
        } else {
            $field.removeClass('input-not-empty');
        }
    }
       
});

</script>

<?php require_once ('footer.php');?>