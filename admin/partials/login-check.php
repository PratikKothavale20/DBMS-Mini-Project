<?php
    // aathorization - Acess Control
    // check whether user in loggedd in or not 
    if(!isset($_SESSION['user'])) // if user session not set
    {
        // user is not logged in
        // redirect to login page with msg
        $_SESSION['no-login-message'] = "<div class='error text-center'>please login to access Admin Panel.</div>";
        // redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }

?>