<?php 
    include_once('config.php');
    include_once("conn.php");

    session_destroy();
    header("Location:" .$url."/login");