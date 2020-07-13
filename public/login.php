

<?php require_once ("../include/header.php");?>
<script type="text/javascript" src="javascript/jquery.validate.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-lg-4 ml-auto mr-auto input_form">
            <h3>Login Now!</h3>

            <form name="login_form" action="login.php" method="post">
                <div class="form-group">
                    <label for="username-input">Username</label>
                    <input type="text" name="username" class="form-control" id="username-input">
                </div>
                <div class="form-group">
                    <label for="password-input">Password</label>
                    <input type="password" name="password" class="form-control" id="password-input">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {

    $.validator.addMethod("validUsername", function (value, element) {
        return /^[a-zA-Z0-9_.-]+$/.test(value);
    }, "The username cannot have white spaces");

    $("form[name='login_form']").validate({
        rules: {
            username: {
                required: true,
                validUsername: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: {
                required: "Username is required field",
                validUsername: "Username cannot contain white spaces"
            },
            password: {
                required: "Password is required field",
                minlength: "Password must be of 6 characters or longer"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

});
</script>

<?php require_once ("../include/footer.php");?>
