<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scorebook1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the MobileNumber column is defined as VARCHAR(10)
$sql = "ALTER TABLE registration1 MODIFY COLUMN MobileNumber VARCHAR(10)";
$conn->query($sql);
?> 
