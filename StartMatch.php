<?php
// Include database connection
include 'DatabaseConnection.php';

// Initialize array for tables
$tables = [];

// Fetch all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0]; // Table names are returned in the first column
    }
    $conn->close();
} else {
    echo "No tables found in the database.";
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Match Details</title>
    <style>
        body {
            background-color: rgba(255, 255, 255, 0.8);
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
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin: 20px auto;
        }
        .navbar h1 {
            margin: 0;
            font-size: 28px;
        }
        .navbar h6 {
            margin-top: 0;
            text-align: center;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
        }
        .form-container select, .form-container input {
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
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .form-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
    </style>
    <script>
        function fetchPlayers(team, containerId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_players.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById(containerId).innerHTML = xhr.responseText;
                }
            };
            xhr.send('team=' + team);
        }

        function displayTeamDetailsJS() {
            var team1 = document.getElementById('team1').value;
            var team2 = document.getElementById('team2').value;
            if (team1) {
                fetchPlayers(team1, 'team1Details');
            }
            if (team2) {
                fetchPlayers(team2, 'team2Details');
            }
            return false; // Prevent form submission
        }

        function toggleCustomOvers() {
            var gameFormat = document.getElementById('gameFormat').value;
            var customOvers = document.getElementById('customOvers');
            var oversInput = document.getElementById('overs');
            if (gameFormat === 'custom') {
                customOvers.style.display = 'block';
                oversInput.value = '';
            } else {
                customOvers.style.display = 'none';
                if (gameFormat === 't10') {
                    oversInput.value = 10;
                } else if (gameFormat === 't20') {
                    oversInput.value = 20;
                } else if (gameFormat === 'oneday') {
                    oversInput.value = 50;
                } else if (gameFormat === 'test') {
                    oversInput.value = 90;
                }
            }
        }
    </script>
</head>
<body>
    <div class="navbar">
        <a href="dashBord.php" class="logo-main">
            <h1>CRICC-SCOREE</h1>
            <h6>YouFollow-WeRecord</h6>
        </a>
        <ul style="font-size: 18px;">
            <li><a href="AddTeamAndPlayer.php">Add Team</a></li>
            <li><a href="DeleteTeam.php">Delete Team</a></li>
        </ul>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <form onsubmit="return displayTeamDetailsJS();">
                <div class="form-row">
                    <div class="form-group">
                        <label for="team1">Select Team 1:</label>
                        <select id="team1" name="team1" required>
                            <option value="" disabled selected>Select Team</option>
                            <?php foreach ($tables as $table): ?>
                                <?php if ($table !== 'registration1'): ?>
                                    <option value="<?php echo $table; ?>"><?php echo $table; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit">Select Players</button>
            </form>
            <div id="team1Details"></div>
        </div>
        <div class="form-container">
            <form onsubmit="return displayTeamDetailsJS();">
                <div class="form-row">
                    <div class="form-group">
                        <label for="team2">Select Team 2:</label>
                        <select id="team2" name="team2" required>
                            <option value="" disabled selected>Select Team</option>
                            <?php foreach ($tables as $table): ?>
                                <?php if ($table !== 'registration1'): ?>
                                    <option value="<?php echo $table; ?>"><?php echo $table; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit">Select Players</button>
            </form>
            <div id="team2Details"></div>
        </div>
        <div class="form-container">
            <form action="StartMatchAction.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Select Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Select Time:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Enter Location:</label>
                        <input type="text" id="location" name="location" placeholder="Enter location" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="ballType">Select Ball Type:</label>
                        <select id="ballType" name="ballType" required>
                            <option value="" disabled selected>Select Ball Type</option>
                            <option value="tennis">Tennis</option>
                            <option value="leather">Leather</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
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
                <button type="submit">Start Match</button>
            </form>
        </div>
    </div>
</body>
</html>
