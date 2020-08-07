<?php session_start();?>
<?php
require_once ("../include/Database/UserDB.php");

if(isset($_POST["submit"])) {
    $db = new UserDB();
    $usernames = $db->getUsernames();
    $username = $_POST['username'];
    if(in_array($username, $usernames) ) {
        $_SESSION['message_error'] = "This username '$username' is already taken. Please choose a different one";
    }
    else {
        $data = array(
            "first_name" => $db->formatName($_POST["first_name"]),
            "last_name" => $db->formatName($_POST["last_name"]),
            "email" => $_POST["email"],
            "phone_number" => $_POST["phone_number"],
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        );
        if ($db->createProfile($data)) {
            $_SESSION['message_success'] = "Profile created successfully!";
            header("location: index.php");
        } else
            $_SESSION['message_error'] = "Profile creation failed!";
    }
}
?>

<?php require_once("header.php");?>
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
                    required: true,
                    email: true,
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

        $("#first-name-input").autocomplete();

    });
</script>

<?php require_once("footer.php");?>
