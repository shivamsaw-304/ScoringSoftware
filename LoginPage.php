<?php
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['PhoneNUMBER'];
    $password1 = $_POST['password1'];

    // Include database connection
    include 'DatabaseConnection.php';

    $sql = "SELECT * FROM registration1 WHERE MobileNumber = '$phone' AND Password1 = '$password1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['PhoneNUMBER'] = $phone; // Set the session variable
        header("Location: dashBord.php");
        exit();
    } else {
        $error = "Invalid phone number or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color :#bc6c25;
        }
        .LoginFace {
            position: relative; /* Added for positioning the video */
            background: #fff;
            padding: 20px;
            height: 70%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            opacity: 0.8;
            overflow: hidden; /* Added to contain the video */
        }
        .LoginFace img {
            display: block;
            margin: 0 auto 20px;
            width: 60px;
            height: 60px;
            opacity: 0.8; /* Slightly Transparent Image */
        }
        .LoginFace button {
            text-align: center;
            width: 32%;
            padding: 10px;
            background-color: #0c73f1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 1%;
            display: inline-block;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            animation: fadeOut 5s ease-in-out forwards;
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        .LoginFace .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.5; /* Adjust opacity as needed */
        }
        .LoginFace button:hover {
            background-color: goldenrod;
        }
        .SignInText h1 {
            font-size: 22px;
            margin-bottom: 20%;
            color: #333;
            text-align: center;
        }
        .Selection, .LoginWith {
            margin-bottom: 20px;
        }
        .Selection label, .LoginWith label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        .Selection select, .LoginWith input {
            width: 90%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
        }

        .terms {
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .terms a {
            color: #f10c0c;
            text-decoration: none;
        }
        .terms a:hover {
            text-decoration: underline;
        }
        .toggle-password {
            position: relative;
        }
        .toggle-password input {
            width: calc(100% - 30px); /* Adjust width for toggle button */
        }
        .toggle-password span {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }
        .toggle-password span {
            cursor: pointer;
        }
        input{
            transform: translatey(-25px);
            color : #0051ff;
        }
        input{
            border-color: #0051ff;
        }
    </style>
</head>
<body>
    <!-- Background Video
    <video class="video-background" autoplay muted loop>
        <source src="Cricket Pitch.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->
  <form method="post">
    <div class="LoginFace">
        <!-- Background Video inside LoginFace -->
        <video class="video-background" autoplay muted>
            <source src="Cricket Pitch.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        
        <div class="SignInText">
            <h1>Sign in to continue</h1>

        </div>
    
        <div class="Selection">
            <label for="State">Select State</label>
            <select name="State" id="State" required>
                <option value="">Select State</option>
                <option value="andhra_pradesh">Andhra Pradesh</option>
                <option value="arunachal_pradesh">Arunachal Pradesh</option>
                <option value="assam">Assam</option>
                <option value="bihar">Bihar</option>
                <option value="chhattisgarh">Chhattisgarh</option>
                <option value="goa">Goa</option>
                <option value="gujarat">Gujarat</option>
                <option value="haryana">Haryana</option>
                <option value="himachal_pradesh">Himachal Pradesh</option>
                <option value="jharkhand">Jharkhand</option>
                <option value="karnataka">Karnataka</option>
                <option value="kerala">Kerala</option>
                <option value="madhya_pradesh">Madhya Pradesh</option>
                <option value="maharashtra">Maharashtra</option>
                <option value="manipur">Manipur</option>
                <option value="meghalaya">Meghalaya</option>
                <option value="mizoram">Mizoram</option>
                <option value="nagaland">Nagaland</option>
                <option value="odisha">Odisha</option>
                <option value="punjab">Punjab</option>
                <option value="rajasthan">Rajasthan</option>
                <option value="sikkim">Sikkim</option>
                <option value="tamil_nadu">Tamil Nadu</option>
                <option value="telangana">Telangana</option>
                <option value="tripura">Tripura</option>
                <option value="uttar_pradesh">Uttar Pradesh</option>
                <option value="uttarakhand">Uttarakhand</option>
                <option value="west_bengal">West Bengal</option>
                <option value="andaman_nicobar">Andaman and Nicobar Islands</option>
                <option value="chandigarh">Chandigarh</option>
                <option value="dadra_nagar_haveli_daman_diu">Dadra and Nagar Haveli and Daman and Diu</option>
                <option value="delhi">Delhi</option>
                <option value="jammu_kashmir">Jammu and Kashmir</option>
                <option value="ladakh">Ladakh</option>
                <option value="lakshadweep">Lakshadweep</option>
                <option value="puducherry">Puducherry</option>
            </select>
        </div>
        <?php if ($error): ?>
            <div style="color: red; text-align: center; margin-bottom: 20px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <div class="LoginWith">
            <label for="PhoneNUMBER" id="PH">Enter Phone Number</label>
            <input type="tel" name="PhoneNUMBER" id="PhoneNUMBER" placeholder="Enter Phone Number" required>
            <label for="password1">Enter Password</label>
            <div class="toggle-password">
                <input type="password" name="password1" id="password" placeholder="Enter password" required>
                <span onclick="togglePassword()">👁️</span>
            </div>
        </div>
      
        <div style="text-align: center;">
            <button type="submit">Login</button>
            <a href="RegisterPage.php">
                <button type="button">Register</button>
            </a>
        </div>
    </div>
  </form>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
        }
    </script>
</body>
</html>
