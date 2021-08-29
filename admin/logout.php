<?php

// 1. Include constants To start the session .
include('../config/constants.php');

// 2. Destroy the Session To log Out .
session_destroy(); 

// 3. Redirect To login page when Clicked to Button logout .
header("location:".SITEURL.'admin/login.php');

?>