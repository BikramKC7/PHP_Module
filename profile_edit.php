<?php include 'Template/header.php'; ?> <!-- Include the header file -->
<?php
session_start();
include "db.php"; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: No user found.");
}

$profile_pic = !empty($user['profile_pic']) ? 'uploads/' . $user['profile_pic'] : 'uploads/default.png'; // Default profile pic

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Sanitize input
    $firstname = $conn->real_escape_string($firstname);
    $lastname = $conn->real_escape_string($lastname);
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);

    // Hash password if provided
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Check if an image is uploaded
    if (!empty($_FILES["profile_pic"]["name"])) {
        $target_dir = "uploads/";

        // Ensure 'uploads' folder exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $profile_pic = basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $profile_pic;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Sanitize the file name
        $profile_pic = preg_replace("/[^a-zA-Z0-9.-_]/", "_", $profile_pic);

        // Move uploaded file
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Update user with new profile picture
            if (isset($hashed_password)) {
                $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', phone='$phone', profile_pic='$profile_pic', password='$hashed_password' WHERE id='$id'";
            } else {
                $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', phone='$phone', profile_pic='$profile_pic' WHERE id='$id'";
            }
        } else {
            die("Error: There was a problem uploading the file.");
        }
    } else {
        // Update user without changing profile picture
        if (isset($hashed_password)) {
            $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', phone='$phone', password='$hashed_password' WHERE id='$id'";
        } else {
            $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', phone='$phone' WHERE id='$id'";
        }
    }

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
        header("Location: profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<link rel="stylesheet" href="Style/pedit.css">



<main class="profile-container">
    <div class="profile-header">
        <h2>Update Your Profile</h2>
        <p>Make sure your information is up-to-date.</p>
    </div>

    <!-- Circular Profile Picture -->
    <div class="profile-pic-container">
        <img src="<?php echo $profile_pic; ?>" alt="Profile Picture" class="profile-pic">
    </div>

    <form method="POST" action="profile_edit.php" enctype="multipart/form-data" class="profile-form">
        <div class="form-group">
            <label for="profile_pic">Update Profile Picture:</label>
            <input type="file" name="profile_pic" accept="image/*">
        </div>

        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">New Password (leave blank to keep current password):</label>
            <input type="password" name="password" placeholder="Enter new password">
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Update Profile</button>
        </div>
    </form>
</main>

<?php include 'Template/footer.php'; ?>
<?php $conn->close(); ?>
