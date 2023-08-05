<?php
// logout.php - This script will handle the logout action

// Start a new session or resume the existing session
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page (adjust the URL as needed)
header("Location: index.php");
exit();
?>
