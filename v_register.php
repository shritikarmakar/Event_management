<?php
// Initialize variables to store user input and messages
$username = "";
$email = "";
$password = "";
$confirmPassword = "";
$errorMessage = "";
$successMessage = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Perform basic input validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Database connection parameters
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "db";

        // Create a database connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password (for security)
        //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $sql = "INSERT INTO v_users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            // Registration successful
            $successMessage = "Registration successful!";
        } else {
            // Registration failed
            $errorMessage = "Registration failed. Please try again.";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* Styles for the signup container */
        .signup-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px #888888;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 50px;
            text-align: center;
        }

        /* Heading style */
        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Form field style */
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        /* Label style */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Input field style */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Button style */
        .btn {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Error message style */
        .error-message {
            color: red;
        }

        /* Success message style */
        .success-message {
            color: green;
        }

        /* Additional styles you can add as needed */
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="v_register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
            
            <a href="v_login.php">Go to the login page</a>
            <br>
            <a href="index.php"> Home</a>
        </form>
    </div>
</body>
</html>