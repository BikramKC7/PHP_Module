<?php
include 'db.php'; // Include the database connection file

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Invalid phone number. Please enter a 10-digit number.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, phone, username, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $phone, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<p class='success'> <a href='login.php'></a></p>";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="Style/signup.css">
</head>
<body>
    <div class="signup-container">
        <form method="POST" action="">
            <h2>Signup</h2>
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="text" name="phone" placeholder="Phone Number (10 digits)" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Signup</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
