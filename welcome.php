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
    <header>
        <h1>Welcome to My Learning Journey</h1>
        <nav>
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="login.php">Logout</a></li>
                <li><a href="crud.php">Crud</a></li>

            </ul>
        </nav>
    </header>

    <main>
        <section class="journey">
            <h2>My PHP and CSS Learning Journey</h2>
            <p>
                Welcome to my personal journey of learning PHP and CSS! 
                I started this journey to enhance my web development skills and create dynamic, interactive websites.
            </p>
            <p>
                Throughout my learning process, I have explored various concepts, including:
            </p>
            <ul>
                <li>Understanding the basics of PHP syntax and structure.</li>
                <li>Working with forms and user input.</li>
                <li>Connecting to databases using MySQL.</li>
                <li>Implementing user authentication and sessions.</li>
                <li>Styling web pages using CSS for a better user experience.</li>
            </ul>
            <p>
                I am excited to continue this journey and build more complex applications in the future!
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Learning Journey. All rights reserved.</p>
    </footer>
</body>
</html>