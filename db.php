<?php

$host = "sql105.infinityfree.com";
$user = "if0_41397338";
$pass = "Yoga2309071945";
$db   = "if0_41397338_mylinks";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Database connection failed");
}

?>
