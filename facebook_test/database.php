<?php
// Replace the following database connection details with your own credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ferdaussk';

// Connect to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}
