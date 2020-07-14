<?php
require_once ("../include/Database/UserDB.php");

if(isset($_POST["submit"]))
{
    $db = new UserDB();
    $data = array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "email" => $_POST["email"],
        "phone_number" => $_POST["phone_number"],
        "username" => $_POST["username"],
        "password" => $_POST["password"]
    );
    if($db->createProfile($data))
        echo"<script>alert('Profile created successfully')</script>";
    else
        echo"<script>alert('Error occurred')</script>";



}
?>

<?php require_once ("../include/header.php");?>
<script type="text/javascript" src="javascript/jquery.validate.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-lg-4 ml-auto mr-auto form_with_shadow">
            <h3>Register Now!</h3>

            <form name="registration_form" action="register.php" method="post">
                <div class="form-group">
                    <label for="first-name-input">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first-name-input">
                </div>
                <div class="form-group">
                    <label for="last-name-input">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last-name-input">
                </div>
                <div class="form-group">
                    <label for="email-input">Email</label>
                    <input type="email" name="email" class="form-control" id="email-input">
                </div>
                <div class="form-group">
                    <label for="phone-number-input">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone-number-input">
                </div>
                <div class="form-group">
                    <label for="username-input">Username</label>
                    <input type="text" name="username" class="form-control" id="username-input">
                    <label for="username-input"><small>It will be used to login to your account</small></label>
                </div>
                <div class="form-group">
                    <label for="password-input">Password</label>
                    <input type="password" name="password" class="form-control" id="password-input">
                </div>
                <div class="form-group">
                    <label for="confirm-password-input">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm-password-input">
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
        }, "The username can only contain letters, numbers, hyphen(-), period(.) and underscore(_)");

        $("form[name='registration_form']").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                  required: true
                },
                email: {
                  required: true
                },
                username: {
                    required: true,
                    validUsername: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password-input"
                }
            },
            messages: {
                confirm_password: {
                    equalTo: "Both password values must be equal"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>

<?php require_once ("../include/footer.php");?>
