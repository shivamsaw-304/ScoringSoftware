<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteTeam'])) {
        // Include database connection
        include 'DatabaseConnection.php';

        // Drop the team table
        $teamName = $_POST['teamName'];
        $dropTeamTable = "DROP TABLE IF EXISTS $teamName";

        if ($conn->query($dropTeamTable) === TRUE) {
            echo "<script>alert('Team deleted successfully!');</script>";
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
    <title>Delete Team</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
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
            width: 50%;
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
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>
<body>
<video class="video-background" muted loop playsinline>
    <source src="groundball.mov" type="video/mp4">
    Your browser does not support the video tag.
</video>
    <div class="navbar" style="padding: 20px; background-color: rgba(0, 0, 0, 0.5); opacity: 1;">
        <div style="display: flex; align-items: center;">
            <div class="logo">
                <a href="AfterLoginMainPage.php">
                    <img src="logo.jpg" alt="Logo" style="width: 70px; height: auto;">
                </a>
            </div>
            <h1 style="font-size: 40px; margin: 0; color: white; padding-left: 20px;">CRICC-SCOREE</h1>
        </div>
      
    </div>
    <div class="form-container">
        <form method="post">
            <label for="teamName"><h1>Enter Team Name</h1></label>
            <input type="text" id="teamName" name="teamName" placeholder="Team Name" required>
            <div class="button-container">
                <button type="submit" name="deleteTeam">Delete Team</button>
            </div>
        </form>
    </div>
</body>
</html>
