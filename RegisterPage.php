<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $state = $_POST['state'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password1 !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Include database connection
        include 'DatabaseConnection.php';

        // Check if mobile number already exists
        $checkMobileSql = "SELECT * FROM registration1 WHERE MobileNumber = '$mobileNumber'";
        $result = $conn->query($checkMobileSql);

        if ($result->num_rows > 0) {
            echo "<script>alert('Mobile number already exists!');</script>";
        } else {
            // Insert new registration
            $sql = "INSERT INTO registration1 (FirstName, LastName, State, MobileNumber, Email, Password1, ConfirmPassword) VALUES ('$firstName', '$lastName', '$state', '$mobileNumber', '$email', '$password1', '$confirmPassword')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successful!'); window.location.href='LoginPage.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background:#20002c;
            ; /* Fallback in case video doesn't load */
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Send video to the background */
        }
        .RegisterFace {
            position: relative; /* Added for positioning the video */
            /* background: rgba(255, 255, 255, 0.9); Slightly transparent for readability */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            overflow: hidden; /* Added to contain the video */
        }
        .RegisterFace .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.5; /* Adjust opacity as needed */
        }
        .logo {
           justify-items :center;      
           
        }
        .logo img{
            mix-blend-mode : screen;
        }
        .logo h2{
            margin-bottom :2px;
        }
        .logo h5{
            margin-top :0px
        }
        .Details {
            display: grid;
            gap: 10px;
        }
        .Details label {
            font-size: 14px;
            color: #333;
        }
        .Details input, .Details select {
            width: 90%; 
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .Details hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        .terms {
            margin-top: 15px;
            font-size: 14px;
        }
        .terms input {
            margin-right: 5px;
        }
        .terms a {
            color: #0c73f1;
            text-decoration: none;
        }
        .terms a:hover {
            text-decoration: underline;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            width: 48%;
            padding: 10px;
            background-color: #0c73f1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px 1%;
        }
        .buttons button:hover {
            background-color: #0056b3;
        }
        .toggle-password span {
            cursor: pointer;
        }
        form{
            opacity : = 0.1;

        }
    </style>
</head>
<body>

<!-- Background Video -->
<!-- <video class="video-background" autoplay muted loop>
    <source src="Cricket Pitch.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video> -->

<div class="RegisterFace">
    <!-- Background Video inside RegisterFace -->
    <video class="video-background" autoplay muted loop>
        <source src="Cricket Pitch.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- Logo -->
    <div class="logo">
       <h2>CRICC-SCORERR</h2>
       <h5>YouFollow WeRecord</h5>

    </div>

    <!-- Registration Form -->
    <form action="RegisterPage.php" method="POST">
        <div class="Details">
            <!-- Name Fields -->
            <label for="Fname">First Name</label>
            <input type="text" id="Fname" name="firstName" placeholder="Enter first name" required>

            <label for="Lname">Last Name</label>
            <input type="text" id="Lname" name="lastName" placeholder="Enter last name" required>

            <hr>

            <!-- State Dropdown -->
            <label for="State">Select State</label>
            <select name="state" id="State" required>
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

            <!-- Contact Information -->
            <label for="Mnumber">Mobile Number</label>
            <input type="tel" id="Mnumber" name="mobileNumber" placeholder="Enter mobile number" required pattern="[0-9]{10}" maxlength="10">

            <label for="Email">Email ID</label>
            <input type="email" id="Email" name="email" placeholder="Enter email address" required>

            <!-- Password Fields -->
            <label for="password">Password</label>
            <div class="toggle-password">
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                <span onclick="togglePassword('password')">👁️</span>
            </div>
            <label for="confirmPassword">Confirm Password</label>
            <div class="toggle-password">
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                <span onclick="togglePassword('confirmPassword')">👁️</span>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms">
            <p>
                <input type="checkbox" name="terms" id="TandC" required>
                By signing up, you agree to our <a href="#">Terms and Conditions</a>.
            </p>
        </div>

        <!-- Submit Button -->
        <div class="buttons">
            <button type="submit">SUBMIT</button>
            <a href="LoginPage.php">Click here to login</a>
        </div>
    </form>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
    }
</script>

</body>
</html>
