<?php
/**
 * Template Name: Registration Template
 * Description: A custom template for user registration.
 */

get_header();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  global $wpdb;
  $table_name = $wpdb->prefix . 'ferdaussk_plugin_test';

  // Retrieve form data
  $first_name = sanitize_text_field($_POST['first_name']);
  $last_name = sanitize_text_field($_POST['last_name']);
  $email = sanitize_email($_POST['email']);
  $password = $_POST['password']; // You should hash and validate the password before saving to the database
  $birthdate = sanitize_text_field($_POST['birthdate']);
  $gender = $_POST['gender'];

  // Insert data into the database
  $wpdb->insert($table_name, array(
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'password' => $password,
    'birthdate' => $birthdate,
    'gender' => $gender,
  ));

  echo '<p>Registration successful!</p>';
}
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="registration-form">
      <h2>Register</h2>
      <form action="" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" id="birthdate" required>

        <label>Gender:</label>
        <input type="radio" name="gender" id="male" value="male" required>
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female" required>
        <label for="female">Female</label>
        
        <input type="submit" value="Register">
      </form>
    </div>

  </main>
</div>
<style>
  /* registration-style.css */
.registration-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.registration-form h2 {
  margin-bottom: 20px;
}

.registration-form label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

.registration-form input[type="text"],
.registration-form input[type="email"],
.registration-form input[type="password"],
.registration-form input[type="date"] {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.registration-form input[type="radio"] {
  margin-right: 6px;
}

.registration-form input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.registration-form input[type="submit"]:hover {
  background-color: #0056b3;
}

</style>
<?php get_footer(); ?>
