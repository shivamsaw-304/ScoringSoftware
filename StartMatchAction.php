<?php
// Include database connection
include 'DatabaseConnection.php';

// Create matches table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1 VARCHAR(255) NOT NULL,
    team2 VARCHAR(255) NOT NULL,
    match_date DATE NOT NULL,
    match_time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    ball_type VARCHAR(50) NOT NULL,
    game_format VARCHAR(50) NOT NULL,
    overs INT
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $ballType = $_POST['ballType'];
    $gameFormat = $_POST['gameFormat'];
    $overs = isset($_POST['overs']) ? $_POST['overs'] : null;

    // Insert match details into the database
    $sql = "INSERT INTO matches (team1, team2, match_date, match_time, location, ball_type, game_format, overs) 
            VALUES ('$team1', '$team2', '$date', '$time', '$location', '$ballType', '$gameFormat', '$overs')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Match started successfully!'); window.location.href='dashBord.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>