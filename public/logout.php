<?php
session_start();
if(isset($_SESSION['user_id']))
{
    $_SESSION['user_id'] = null;
    $_SESSION['username'] = null;
    $_SESSION['message_success'] = "Logged out successfully!";
}
header("Location: index.php");
