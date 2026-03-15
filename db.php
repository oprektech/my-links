<?php

$host = "https://oaecibokcofhmhzdojak.supabase.co";
$port = "5432";
$db   = "postgres";
$user = "postgres";
$pass = "Yoga2309071945";

$conn = pg_connect(
  "host=$host port=$port dbname=$db user=$user password=$pass"
);

if(!$conn){
    die("Database connection failed");
}

?>
