<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style/welcome.css">
    

</head>
<body>
    <?php include 'Template/header.php'; ?> <!-- Include the header file -->

    <main>
            <!-- Hero landing Section -->
        <section class="split-section">
            <div class="left-side">
                <h1 class="main-heading">
                    <span class="orange-text">Ghar-Tution</span><br>
                    <span>Each Student Needs </span><br>
                    <span>Quality Education & Special Attention</span>
                </h1>
                <p class="subtext">
               We Proved provides personalized learning, one-on-one attention, and a comfortable study environment, helping students improve their academic performance and build confidence. It ensures flexible learning schedules and tailored teaching methods to suit individual learning needs.</p>
                <button class="feature-button"><a href="welcome.php">Ghar-Tuition</a></button>
            </div>
            <div class="right-side">
                <img src="uploads/tuition.jpg" alt="Inspiring Image" />
                
            </div>
        </section>

        <!-- Quote Rectangle -->
        <div class="quote-rectangle">
            <p class="quote-text">
                "You don’t have to struggle with learning alone. You just need the right guidance to unlock your potential." - Ghar-Tution
            </p>
        </div>

    </main>

    <?php include 'Template/footer.php'; ?> <!-- Include the footer file -->
</body>
</html>