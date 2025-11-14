<?php

$host = "db";
$user = "root";
$password = "root123";
$database = "sictel";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>