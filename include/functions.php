<?php
function display_message() {
?>
    <?php if(isset($_SESSION['message_info'])):?>
        <div class="alert alert-dismissible alert-info mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?=$_SESSION['message_info'];?></b>
        </div>
        <?php $_SESSION['message_info'] = null;?>

    <?php elseif (isset($_SESSION['message_error'])):?>
        <div class="alert alert-dismissible alert-danger mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?=$_SESSION['message_error'];?></b>
        </div>
        <?php $_SESSION['message_error'] = null;?>

    <?php elseif (isset($_SESSION['message_success'])):?>
        <div class="alert alert-dismissible alert-success mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?=$_SESSION['message_success'];?></b>
        </div>
        <?php $_SESSION['message_success'] = null;?>

    <?php endif;?>

<?php
}