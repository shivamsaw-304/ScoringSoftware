<?php
// Include database connection
include 'DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tournamentName = $_POST['tournamentName'];
    $city = $_POST['city'];
    $organizerName = $_POST['organizerName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $ballType = $_POST['ballType'];
    $gameFormat = $_POST['gameFormat'];
    $overs = isset($_POST['overs']) ? $_POST['overs'] : null;

    // Insert new tournament
    $sql = "INSERT INTO tournaments (TournamentName, City, OrganizerName, StartDate, EndDate, BallType, GameFormat, Overs) VALUES ('$tournamentName', '$city', '$organizerName', '$startDate', '$endDate', '$ballType', '$gameFormat', '$overs')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tournament added successfully!'); window.location.href='dashBord.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tournament</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #333;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .navbar .logo-main {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.3);
        }
        .navbar h1 {
            margin: 0;
            font-size: 28px;
        }
        .navbar h6 {
            margin-top: 0;
            text-align: center;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
            font-size: 18px;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        .navbar ul li a:hover {
            text-decoration: underline;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 50%;
            text-align: center;
            margin: 20px auto;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
        }
        .form-container input, .form-container select {
            width: 70%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #0c73f1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function toggleCustomOvers() {
            var gameFormat = document.getElementById('gameFormat').value;
            var customOvers = document.getElementById('customOvers');
            if (gameFormat === 'custom') {
                customOvers.style.display = 'block';
            } else {
                customOvers.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="navbar">
        <div class="logo-main">
            <h1>CRICC-SCOREE</h1>
            <h6>YouFollow-WeRecord</h6>
        </div>
        <ul>
            <li><a href="dashBord.php">Dashboard</a></li>
            <li><a href="StartMatch.php">Start Match</a></li>
        </ul>
    </div>
    <div class="form-container">
        <form method="post" action="AddTournament.php">
            <label for="tournamentName">Tournament Name:</label>
            <input type="text" id="tournamentName" name="tournamentName" placeholder="Enter tournament name" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="Enter city" required>

            <label for="organizerName">Organizer Name:</label>
            <input type="text" id="organizerName" name="organizerName" placeholder="Enter organizer name" required>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>

            <label for="ballType">Ball Type:</label>
            <select id="ballType" name="ballType" required>
                <option value="" disabled selected>Select Ball Type</option>
                <option value="tennis">Tennis</option>
                <option value="leather">Leather</option>
                <option value="other">Other</option>
            </select>
            <div class="form-row">
                <div class="form-group">
                    <label for="gameFormat">Select Game Format:</label>
                    <select id="gameFormat" name="gameFormat" onchange="toggleCustomOvers()" required>
                        <option value="" disabled selected>Select Game Format</option>
                        <option value="t10">T10</option>
                        <option value="t20">T20</option>
                        <option value="oneday">One Day</option>
                        <option value="test">Test</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>
            <div class="form-row" id="customOvers" style="display: none;">
                <div class="form-group">
                    <label for="overs">Enter Overs:</label>
                    <input type="number" id="overs" name="overs" min="1" placeholder="Enter number of overs">
                </div>
            </div>
            <button type="submit">Add Tournament</button>
        </form>
    </div>
</body>
</html>
