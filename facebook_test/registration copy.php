<?php
include('database.php');

// Function to perform user registration
function registerUser($firstName, $lastName, $email, $reenterEmail, $password, $birthdate, $gender) {
    global $connection;

    // Sanitize user inputs to prevent SQL injection
    $firstName = mysqli_real_escape_string($connection, $firstName);
    $lastName = mysqli_real_escape_string($connection, $lastName);
    $email = mysqli_real_escape_string($connection, $email);
    $reenterEmail = mysqli_real_escape_string($connection, $reenterEmail);
    $password = mysqli_real_escape_string($connection, $password);
    $birthdate = mysqli_real_escape_string($connection, $birthdate);
    $gender = mysqli_real_escape_string($connection, $gender);

    // Check if both email fields match
    if ($email !== $reenterEmail) {
        return 'Emails do not match.';
    }

    // Check if the email is already registered
    $emailCheckQuery = "SELECT * FROM new_users WHERE email = '$email'";
    $emailCheckResult = mysqli_query($connection, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult) > 0) {
        return 'Email is already registered.';
    }

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the 'new_users' table
    $query = "INSERT INTO new_users (first_name, last_name, email, password, birthdate, gender) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$birthdate', '$gender')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Registration successful
        return true;
    } else {
        // Registration failed
        return 'Registration failed.';
    }
}

// Usage example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form is submitted, perform user registration
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['reenter_email']) && isset($_POST['password']) && isset($_POST['birthdate']) && isset($_POST['gender'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $reenterEmail = $_POST['reenter_email'];
        $password = $_POST['password'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];

        $registrationResult = registerUser($firstName, $lastName, $email, $reenterEmail, $password, $birthdate, $gender);

        if ($registrationResult === true) {
            // Registration successful, perform further actions (e.g., redirect to user dashboard)
            echo "Registration successful!";
        } else {
            // Registration failed, display error message or redirect back to registration form
            echo $registrationResult;
        }
    }
}

// Don't forget to close the database connection when you're done using it
mysqli_close($connection);
?>
