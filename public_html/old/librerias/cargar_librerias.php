<?php
session_start();
$hostname_db = "localhost";
$database_db = "sondemig_datos";
$username_db = "sondemig_user";
$password_db = "@Reggae91";
$conex = mysqli_connect($hostname_db, $username_db, $password_db, $database_db);
error_reporting(E_ALL);
ini_set("dispay_errors", 1);
mysqli_set_charset($conex, 'utf8');

?>
