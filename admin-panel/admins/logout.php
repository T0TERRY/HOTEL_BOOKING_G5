<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: http://localhost:3000/hotel-booking/admin-panel/admins/login-admins.php");

?>