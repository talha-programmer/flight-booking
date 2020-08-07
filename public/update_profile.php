<?php
session_start();
if(!isset($_SESSION['first_name'])) {
    header('Location: index.php');
    exit;
}
require_once ("../include/Database/UserDB.php");

if(isset($_POST["submit"])) {
    $db = new UserDB();
    $user_id = $_SESSION['user_id'];
    $data = array(
        "first_name" => $db->formatName($_POST["first_name"]),
        "last_name" => $db->formatName($_POST["last_name"]),
        "email" => $_POST["email"],
        "phone_number" => $_POST["phone_number"]
    );
    if($db->updateProfile($user_id, $data))
        $_SESSION['message_success'] = "Profile updated successfully!";
    else
        $_SESSION['message_error'] = "Profile update failed!";
    header('Location: profile.php');
    exit;
}
?>

<?php require_once("header.php");?>
<script type="text/javascript" src="javascript/jquery.validate.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-lg-4 ml-auto mr-auto form_with_shadow">
            <h3>Update Profile!</h3>
            <form name="update_form" action="update_profile.php" method="post">
                <div class="form-group">
                    <label for="first-name-input">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first-name-input" value="<?=$_SESSION['first_name']?>">
                </div>
                <div class="form-group">
                    <label for="last-name-input">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last-name-input" value="<?=$_SESSION['last_name']?>">
                </div>
                <div class="form-group">
                    <label for="email-input">Email</label>
                    <input type="email" name="email" class="form-control" id="email-input" value="<?=$_SESSION['email']?>">
                </div>
                <div class="form-group">
                    <label for="phone-number-input">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone-number-input" value="<?=$_SESSION['phone_number']?>">
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

        $("form[name='update_form']").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
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

<?php require_once("footer.php");?>
