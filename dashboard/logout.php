<?php
require 'inc/config.php';
session_start();
    if(session_destroy()){
        header('location: index');
    }


?>