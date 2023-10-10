<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styles for the login container */
        .login-container {
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <form action="authenticate.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <?php
        // Display error message if login failed
        if (!empty($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }
        ?>
        <a href="register.php">Create an account</a>
        <br>
            <a href="index.php"> Home</a>
    </div>
    
</body>
</html>
