<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "wideworldimporters";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected!";

