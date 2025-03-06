<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scorerregister1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $state = $_POST['state'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (firstName, middleName, lastName, state, mobileNumber, email)
            VALUES ('$firstName', '$middleName', '$lastName', '$state', '$mobileNumber', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
