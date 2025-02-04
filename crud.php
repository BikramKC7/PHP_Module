<?php
session_start();
include 'db.php'; // Include the database connection file

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for creating a new tuition post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $class = $_POST['class'];
    $time = $_POST['time'];
    $preferred_gender = $_POST['preferred_gender'];
    $tuition_fee = $_POST['tuition_fee'];

    $sql = "INSERT INTO tuition_posts (name, phone, email, location, class, time, preferred_gender, tuition_fee) 
            VALUES ('$name', '$phone', '$email', '$location', '$class', '$time', '$preferred_gender', '$tuition_fee')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Tuition post created successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tuition_posts WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Tuition post deleted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error deleting post: " . $conn->error . "</p>";
    }
}

// Fetch existing tuition posts
$sql = "SELECT * FROM tuition_posts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style/crud.css">
    <script>
        function toggleForm() {
            var form = document.getElementById("tuitionForm");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        }
    </script>
</head>
<body>
    <header>
        <h1>Tuition Posts</h1>
        <nav>
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="crud.php">CRUD Operations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="crud-form">
            <h2>Post Tuition</h2>
            <button onclick="toggleForm()">Toggle Tuition Form</button>
            <div id="tuitionForm" style="display:none;">
                <form method="POST" action="">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="phone" placeholder="Phone Number" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="location" placeholder="Location" required>
                    <input type="text" name="class" placeholder="Class" required>
                    <input type="text" name="time" placeholder="Time" required>
                    <select name="preferred_gender" required>
                        <option value="">Preferred Gender of Tutor</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Any">Any</option>
                    </select>
                    <input type="number" name="tuition_fee" placeholder="Tuition Fee" required>
                    <button type="submit">Post Tuition</button>
                </form>
            </div>
        </section>

        <section class="tuition-posts">
            <h2>Existing Tuition Posts</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Class</th>
 <th>Time</th>
                    <th>Preferred Gender</th>
                    <th>Tuition Fee</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['class']}</td>
                                <td>{$row['time']}</td>
                                <td>{$row['preferred_gender']}</td>
                                <td>{$row['tuition_fee']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='edit-button'>Edit</a>
                                    <a href='crud.php?delete={$row['id']}' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No tuition posts available.</td></tr>";
                }
                ?>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Tuition Management System</p>
    </footer>
</body>
</html>