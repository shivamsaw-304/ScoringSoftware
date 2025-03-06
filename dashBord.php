<?php
// Include database connection
include 'DatabaseConnection.php';

// Fetch user details using mobile number
session_start();
if (!isset($_SESSION['PhoneNUMBER'])) {
    header("Location: LoginPage.php");
    exit();
}
$mobileNumber = $_SESSION['PhoneNUMBER'];
$sql = "SELECT * FROM registration1 WHERE MobileNumber = '$mobileNumber'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        .profile-view {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-view img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-view .profile-name {
            font-size: 16px;
            color: white;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 50px);
            flex-direction: column;
        }
        .buttonn {
            padding: 10px 20px;
            background-color: #0c73f1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: block;
            text-align: center;
            margin: 10px auto;
            width: 200px;
        }
        .buttonn:hover {
            background-color: #0056b3;
        }
        .profile-details {
            position: fixed;
            top: 0;
            right: -800px;
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            padding: 20px;
            transition: right 0.3s ease;
            z-index: 1000;
        }
        .profile-details h2 {
            margin-top: 0;
        }
        .profile-details p {
            margin: 10px 0;
        }
        .profile-details .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: #333;
        }
        .statement {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .statement h1 {
            font-size: 24px;
            color: #333;
        }
    </style>
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
        <div class="profile-view" onclick="toggleProfileDetails()">
            <?php if ($user): ?>
                <img src="user.png" alt="Profile Photo">
                <div class="profile-name"><?php echo $user['FirstName'] . ' ' . $user['LastName']; ?></div>
            <?php else: ?>
                <p>User details not found.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="statement">
        <h1>Welcome to our scoring software! This powerful tool enables you to record and manage local tournament scores effortlessly, helping players maintain their performance records with ease. Designed specifically for cricket, our software supports accurate and efficient scoring, ensuring a seamless experience for both players and organizers.</h1>
    </div>

    <div class="profile-details" id="profileDetails">
        <span class="close-btn" onclick="toggleProfileDetails()">&times;</span>
        <?php if ($user): ?>
            <h2><?php echo $user['FirstName'] . ' ' . $user['LastName']; ?></h2>
            <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
            <p><strong>Mobile Number:</strong> <?php echo $user['MobileNumber']; ?></p>
            <p><strong>State:</strong> <?php echo $user['State']; ?></p>
        <?php else: ?>
            <p>User details not found.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleProfileDetails() {
            const profileDetails = document.getElementById('profileDetails');
            if (profileDetails.style.right === '0px') {
                profileDetails.style.right = '-800px';
            } else {
                profileDetails.style.right = '0px';
            }
        }
    </script>
</body>
</html>