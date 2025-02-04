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
?>

<link rel="stylesheet" href="Style/profile.css">
<?php include 'Template/header.php'; ?> <!-- Include the header file -->


<main class="profile-container">
    <!-- <div class="profile-details"> -->
        <div class="profile-header">
            <h2>Update Your Profile</h2>
            <p>Make sure your information is up-to-date.</p>
        </div>
        
        <!-- Circular Profile Picture -->
        <div class="profile-pic-container">
            <img src="<?php echo $profile_pic; ?>" alt="Profile Picture" class="profile-pic">
        </div>

        <div class="profile-info">
        <div class="profile-row">
            <div class="profile-item">
                <h3>First Name:</h3>
                <p><?php echo htmlspecialchars($user['firstname']); ?></p>
            </div>
            <div class="profile-item">
                <h3>Last Name:</h3>
                <p><?php echo htmlspecialchars($user['lastname']); ?></p>
            </div>
            <div class="profile-item">
                <h3>Username:</h3>
                <p><?php echo htmlspecialchars($user['username']); ?></p>
            </div>
        </div>

        <div class="profile-row">
            <div class="profile-item">
                <h3>Email:</h3>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="profile-item">
                <h3>Phone Number:</h3>
                <p><?php echo htmlspecialchars($user['phone']); ?></p>
            </div>
        </div>

        <div class="edit-btn-container">
            <a href="profile_edit.php" class="edit-profile-btn">Edit Profile</a>
        </div>
    </div>
</div>

</main>

<?php include 'Template/footer.php'; ?>
<?php $conn->close(); ?>
