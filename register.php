<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }

        .signup-container {
            background-color: #ffffff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #888888;
        }

        .signup-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php
        // Initialize variables to store user input and messages
        $email = "";
        $category = "";
        $username = "";
        $password = "";
        $confirmPassword = "";
        $errorMessage = "";
        $successMessage = "";

        // Check if the signup form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve user input
            $email = $_POST["email"];
            $category = $_POST["category"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];

            // Validate the data (add more validation as needed)
            if (empty($email) || empty($category) || empty($username) || empty($password) || empty($confirmPassword)) {
                $errorMessage = "All fields are required.";
            } elseif ($password !== $confirmPassword) {
                $errorMessage = "Passwords do not match.";
            } else {
                // Database connection (replace with your actual database credentials)
                $servername = "localhost";
                $db_username = "root";
                $db_password = "";
                $dbname = "db";

                $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert user data into the database (replace with your table structure)
                //$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

                $sql = "INSERT INTO users (email, category, username, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $email, $category, $username, $password);

                if ($stmt->execute()) {
                    $successMessage = "Registration successful!";
                } else {
                    $errorMessage = "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            }
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <option value="Catering">Catering</option>
                    <option value="Florist">Florist</option>
                    <option value="Decoration">Decoration</option>
                    <option value="Lightening">Lightening</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>

            <button type="submit" class="btn">Sign Up</button>
            <a href="login.php">Go to the login page</a>
            <br>
            <a href="index.php"> Home</a>
        </form>
        <?php
        // Display error message if signup failed
        if (!empty($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }

        // Display success message if signup was successful
        if (!empty($successMessage)) {
            echo '<p class="success-message">' . $successMessage . '</p>';
        }
        ?>
    </div>
</body>
</html>
