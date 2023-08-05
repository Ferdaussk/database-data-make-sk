<?php
include('database.php');
// Function to perform login check
function loginCheck($email, $password) {
    global $connection;

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM wp_sk_users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        return false; // User not found
    }

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        return $user; // Login successful, return user data
    } else {
        return false; // Incorrect password
    }
}

// Usage example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form is submitted, perform login check
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userData = loginCheck($email, $password);

        if ($userData) {
            // Login successful, perform further actions (e.g., redirect to user dashboard)
            // You can use $userData['id'] to get the user's ID and fetch additional data from the 'user_profiles' table
            include('user_front_view.php');
        } else {
            // Login failed, display error message or redirect back to login page
            echo "Invalid credentials!";
        }
    }
}

// Don't forget to close the database connection when you're done using it
// mysqli_close($connection);
?>
