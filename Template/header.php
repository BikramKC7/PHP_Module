<!-- <header id="header"> -->
    <div class="navbar">
        <!-- Left Side: Navigation Links -->
        <nav class="nav-links">
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="crud.php">Tuition Post</a></li>

            </ul>
        </nav>

        <!-- Right Side: Profile Icon -->
        <div class="profile-logo">
            <div class="profile-icon" onclick="toggleDropdown()">
                <!-- Using Font Awesome for profile icon -->
                <i class="fas fa-user"></i>
            </div>
            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="dropdown-menu">
                <a href="index.php">Sign Up</a>
                <a href="login.php">Login</a>
            </div>
        </div>
    </div>
<!-- </header> -->

<!-- Link External CSS and JS -->
<link rel="stylesheet" href="Style/header.css">

<script src="JsLogic/header.js"></script>

<!-- Link to Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
