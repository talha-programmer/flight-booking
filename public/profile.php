<?php
session_start();
require_once ('../include/Database/UserDB.php');
$username = $email = $phone_number = $first_name = $last_name = null;
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $db = new UserDB();
    if($profile = $db->getProfile($user_id)) {
        $username = $_SESSION['username'];
        $first_name = $profile['first_name'];
        $last_name = $profile['last_name'];
        $phone_number = $profile['phone_number'];
        $email = $profile['email'];

        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone_number'] = $phone_number;
    }
    else {
        $_SESSION['message_error'] = 'error occurred while displaying profile!';
        header('Location: index.php');
        exit;
    }
}
else {
    $_SESSION['message_error'] = "You must log in first to access your profile!";
    header("location: login.php");
    exit;
}
?>
<?php require_once('header.php'); ?>
<div class="container" style="min-height: 83vh;">
    <div class="row">
        <div class="col-sm-7 offset-md-2 offset-lg-3 mt-5">
            <h3>Profile</h3>
            <table class="table">
                <tr>
                    <td>Username: </td> <td><?=$username?></td>
                </tr>
                <tr>
                   <td>First Name: </td> <td><?=$first_name?></td>
               </tr>
                <tr>
                    <td>Last Name: </td> <td><?=$last_name?></td>
                </tr>
                <tr>
                    <td>Email: </td> <td><?=$email?></td>
                </tr>
                <tr>
                    <td>Phone Number: </td> <td><?=$phone_number?></td>
                </tr>
            </table>
            <a class="btn btn-primary" href="update_profile.php">Update Profile</a>
        </div>
    </div>
</div>
<?php require_once('footer.php');?>
