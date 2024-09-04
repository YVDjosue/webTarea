<?php
session_start();
include('security.php');
session_destroy();
header('Location: login.php');
?>
