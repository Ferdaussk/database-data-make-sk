<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Social Media</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>A Social Media</h1>
        <div class="user-profile">
            <img src="https://via.placeholder.com/40" alt="User Profile Picture">
            <span>User Name</span>
            <a href="#">Logout</a>
        </div>
    </header>

    <div class="container">
        <h2><a href="new_one">SK </a>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <button type="submit">Log In</button>
                <div class="link-button" onclick="openPopup()">New Registration</div>
            </div>
        </form>
    </div>

    <div class="popup" id="registrationPopup">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <h2>New Registration</h2>
        <form action="registration.php" method="post" enctype="multipart/form-data">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
            <br>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
            <br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="reenter_email">Re-enter Email</label>
            <input type="email" id="reenter_email" name="reenter_email" required>
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" name="birthdate" required>
            <br>
            <!-- Profile Image start -->
            <label for="profileImage">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image">
            <br>
            <!-- Profile Image end -->
            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" required>
            <label for="female">Female</label>
            <br>
            <button type="submit">Sign Up</button>
        </form>
        <!-- okey i maked the column in database table. now repaire the registerUser() function with <input type="file" id="profile_image" name="profile_image"> -->
    </div>
    <script src="script.js"></script>
</body>
</html>
