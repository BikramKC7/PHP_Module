<?php
session_start();
include 'db.php'; // Include the database connection file

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch the post to be edited
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tuition_posts WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle form submission for updating the tuition post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $class = $_POST['class'];
    $time = $_POST['time'];
    $preferred_gender = $_POST['preferred_gender'];
    $tuition_fee = $_POST['tuition_fee'];

    $sql = "UPDATE tuition_posts SET name='$name', phone='$phone', email='$email', location='$location', class='$class', time='$time', preferred_gender='$preferred_gender', tuition_fee='$tuition_fee' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Tuition post updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating post: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tuition Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Tuition Post</h1>
        <nav>
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="crud.php">CRUD Operations</a></li>
                < li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="edit-form">
            <h2>Edit Post</h2>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required>
                <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $row['phone']; ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                <input type="text" name="location" placeholder="Location" value="<?php echo $row['location']; ?>" required>
                <input type="text" name="class" placeholder="Class" value="<?php echo $row['class']; ?>" required>
                <input type="text" name="time" placeholder="Time" value="<?php echo $row['time']; ?>" required>
                <select name="preferred_gender" required>
                    <option value="<?php echo $row['preferred_gender']; ?>"><?php echo $row['preferred_gender']; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Any">Any</option>
                </select>
                <input type="number" name="tuition_fee" placeholder="Tuition Fee" value="<?php echo $row['tuition_fee']; ?>" required>
                <button type="submit">Update Tuition Post</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Tuition Management System</p>
    </footer>
</body>
</html>