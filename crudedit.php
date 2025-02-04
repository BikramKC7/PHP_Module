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
    <?php include 'Template/header.php'; ?> <!-- Include the header file -->
    <link rel="stylesheet" href="Style/edit.css">
    <main class="main">
        <section class="edit-form">
            <h2>Edit Post</h2>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter Name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="Enter Phone Number" value="<?php echo $row['phone']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter Email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" placeholder="Enter Location" value="<?php echo $row['location']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Class</label>
                        <input type="text" name="class" placeholder="Enter Class" value="<?php echo $row['class']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Preferred Time</label>
                        <input type="text" name="time" placeholder="Enter Time" value="<?php echo $row['time']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Preferred Gender</label>
                        <select name="preferred_gender" required>
                            <option value="<?php echo $row['preferred_gender']; ?>"><?php echo $row['preferred_gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Any">Any</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tuition Fee</label>
                        <input type="number" name="tuition_fee" placeholder="Enter Tuition Fee" value="<?php echo $row['tuition_fee']; ?>" required>
                    </div>
                </div>

                <button type="submit">Update Tuition Post</button>
            </form>
        </section>
</main>


    <?php include 'Template/footer.php'; ?>
    
</body>
</html>