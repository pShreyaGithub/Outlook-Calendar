<?php
    session_start();

    session_destroy();
    header("Location:http://localhost/new/index.php");
?>