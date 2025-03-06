<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRICC-SCOREE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background:#bc6c25;
            color: white;
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
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
            margin-right: 10%;
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
        .content {
            text-align: center;
            margin-top: 100px;
        }
        .content h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 24px;
            margin-bottom: 40px;
        }
        .buttons {
            display: flex;
            gap: 20px;
        }
        .buttons a {
            padding: 10px 20px;
            background-color: #0c73f1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .buttons a:hover {
            background-color: #0056b3;
        }
        .logo-main h1 {
            font-size: 36px;
            margin: 0;
        }
        .logo-main h6 {
            font-size: 18px;
            margin: 0;
            color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-main">
            <h1>CRICC-SCOREE</h1>
            <h6>YouFollow-WeRecord</h6>
        </div>
        <ul>
            <li><a href="RegisterPage.php">Register</a></li>
            <li><a href="LoginPage.php">Login</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to CRICC-SCOREE</h1>
        <p>Your ultimate cricket scoring companion</p>
        <div class="buttons">
            <a href="RegisterPage.php">Register</a>
            <a href="LoginPage.php">Login</a>
        </div>
    </div>
</body>
</html>
