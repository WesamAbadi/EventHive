<?php
// Include the database configuration file
require_once 'config.php';

// Initialize the session
session_start();

// Check if the user is already logged in, if yes, redirect to the home page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

// Process the registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username is already taken
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        // Insert a new user record
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);

        // Redirect to the login page
        header('Location: login.php');
        exit;
    } else {
        $registerError = 'Username is already taken.';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Event Manager</title>
    <style>
        /* Common Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-link {
            color: #4CAF50;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        /* Specific Styling for login.php */
        .login-form {
            margin-top: 50px;
        }

        /* Specific Styling for register.php */
        .register-form {
            margin-top: 20px;
        }

        /* Styling for the Index page */
        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .event {
            width: 300px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .event h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
        }

        .event p {
            margin-top: 0;
            margin-bottom: 10px;
            color: #777;
        }

        .event-likes {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .like-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .like-button:hover {
            background-color: #45a049;
        }

    </style>

</head>
<body>
<div class="container">
    <h1>Register</h1>
    <form action="" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <?php if (isset($registerError)) : ?>
            <div class="error"><?php echo $registerError; ?></div>
        <?php endif; ?>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
