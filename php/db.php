<?php

$host = "sql103.infinityfree.com";
$username = "if0_42700237";
$password = "Pjpaluga0954";
$database = "if0_42700237_XXX";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");



?>