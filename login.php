<?php
session_start();
include 'db.php'; // Database connection

$error = ""; // Store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']); // Accept either username or email
    $password = $_POST['password'];

    // Secure prepared statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password hash
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id']; // Store user ID
            $_SESSION['username'] = $row['username'];

            // Redirect to welcome page or dashboard
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No user found with that username or email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Style/login.css">
</head>

<body>
    
   
    <div class="login-container">
     
        <form method="POST" action="">
            <h2>Login</h2>
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
            
            <input type="text" name="login" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="index.php">Signup</a></p>
        </form>
    </div>
</body>
</html>
