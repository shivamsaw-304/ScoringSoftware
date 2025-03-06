<?php
require 'DatabaseConnection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['team'])) {
    $team = trim($_POST['team']); // Trim spaces

    // Validate table name to prevent SQL injection
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $team)) {
        die("<p>Invalid team name.</p>");
    }

    // Fetch players from the selected team
    $sql = "SELECT player_name FROM `$team`";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<div style='display: flex; flex-direction: column; gap: 8px; padding: 10px; border: 1px solid #ddd; border-radius: 8px; width: 250px; background-color: #f9f9f9;'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div style='display: flex; align-items: center; gap: 10px; padding: 8px; border-radius: 5px; background: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>
                    <input type='checkbox' name='players[]' value='" . htmlspecialchars($row['player_name']) . "' 
                    style='width: 18px; height: 18px; cursor: pointer;'>
                    <span style='font-size: 16px; font-weight: bold;'>" . htmlspecialchars($row['player_name']) . "</span>
                  </div>";
        }

        echo "</div>";
    } else {
        echo "<p>No players found for this team.</p>";
    }

    $conn->close();
}
?>
