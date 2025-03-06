<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addTeam'])) {
        // Include database connection
        include 'DatabaseConnection.php';

        // Create table for the new team
        $teamName = $_POST['teamName'];
        $teamName = preg_replace('/[^a-zA-Z0-9_]/', '_', $teamName); // Sanitize table name
        $createTeamTable = "CREATE TABLE IF NOT EXISTS `$teamName` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            player_name VARCHAR(255) NOT NULL,
            captain BOOLEAN DEFAULT FALSE,
            vicecaptain BOOLEAN DEFAULT FALSE,
            batsman BOOLEAN DEFAULT FALSE,
            bowler BOOLEAN DEFAULT FALSE,
            supersub BOOLEAN DEFAULT FALSE
        )";

        if ($conn->query($createTeamTable) === TRUE) {
            // Insert players into the new team table
            for ($i = 1; isset($_POST["player$i"]); $i++) {
                $playerName = $_POST["player$i"];
                $captain = isset($_POST["player{$i}_captain"]) ? 1 : 0;
                $vicecaptain = isset($_POST["player{$i}_vicecaptain"]) ? 1 : 0;
                $batsman = isset($_POST["player{$i}_batsman"]) ? 1 : 0;
                $bowler = isset($_POST["player{$i}_bowler"]) ? 1 : 0;
                $supersub = isset($_POST["player{$i}_supersub"]) ? 1 : 0;

                $insertPlayer = "INSERT INTO `$teamName` (player_name, captain, vicecaptain, batsman, bowler, supersub) VALUES ('$playerName', $captain, $vicecaptain, $batsman, $bowler, $supersub)";
                $conn->query($insertPlayer);
            }

            echo "<script>alert('Team created and players inserted successfully!');</script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team and Players</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            text-decoration: none;
            color: white;
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
            margin: 20px auto;
            opacity: 0.8;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
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
        .player-fields {
            margin-top: 20px;
            position: relative;
            padding-right: 40px;
        }
        .remove-player {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #f11f0c;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 2px 5px;
            font-size: 12px;
            height: 20px;
            width: 20px;
        }
        .player-fields label {
            display: block;
            margin-bottom: 5px;
        }
        .player-fields input[type="text"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
        }
        .player-fields .roles {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .scrollable-container {
            max-height: 600px;
            overflow-y: auto;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .button-container button {
            flex: 1;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .form-container form {
            width: 100%;
            max-width: 800px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
    <script>
        let playerCount = 0;

        function addPlayerField() {
            playerCount++;
            const container = document.getElementById('team-players');
            const playerDiv = document.createElement('div');
            playerDiv.className = 'player-fields';
            playerDiv.innerHTML = `
                <label for="player${playerCount}">Player ${playerCount} Name</label>
                <input type="text" id="player${playerCount}" name="player${playerCount}" placeholder="Player ${playerCount} Name" required>
                <div class="roles">
                    <label><input type="checkbox" name="player${playerCount}_captain"> Captain</label>
                    <label><input type="checkbox" name="player${playerCount}_vicecaptain"> Vice Captain</label>
                    <label><input type="checkbox" name="player${playerCount}_batsman"> Batsman</label>
                    <label><input type="checkbox" name="player${playerCount}_bowler"> Bowler</label>
                    <label><input type="checkbox" name="player${playerCount}_supersub"> Super Sub</label>
                </div>
                <button type="button" class="remove-player" onclick="removePlayerField(this)">Remove</button>
            `;
            container.appendChild(playerDiv);
        }

        function removePlayerField(button) {
            const playerDiv = button.parentElement;
            playerDiv.remove();
        }
    </script>
</head>
<body>

<div class="navbar">
    <a href="dashBord.php" class="logo-main">
        <h1>CRICC-SCOREE</h1>
        <h6>YouFollow-WeRecord</h6>
    </a>
    <ul>
        <li><a href="StartMatch.php">Start a New Match</a></li>
        <li><a href="AddTournament.php">Add Tournament</a></li>
        <li><a href="LandingPage.php">Logout</a></li>
    </ul>
</div>

<div class="form-container" style="height: 100vh; width: 100%; display: flex; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.8);">
    <form method="post" style="width: 100%; max-width: 800px; height: auto; display: flex; flex-direction: column; justify-content: center;">
        <label for="teamName"><h1>Enter Team Name</h1></label>
        <input type="text" id="teamName" name="teamName" placeholder="Team Name" required>
        <div class="scrollable-container" id="team-players" style="flex-grow: 1;"></div>
        <div class="button-container">
            <button type="button" onclick="addPlayerField()">Add Player</button>
            <button type="submit" name="addTeam">Add Team</button>
        </div>
    </form>
</div>

<script>
    function showForm(formType) {
        document.getElementById('delete-form').style.display = 'none';

        if (formType === 'delete') {
            document.getElementById('delete-form').style.display = 'block';
        }
    }
</script>
</body>
</html>
