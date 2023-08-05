<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to the database (replace with your own database credentials)
    include('database.php');
    
    // Get the form data
    $postContent = mysqli_real_escape_string($connection, $_POST["post_content"]);

    // Check if an image was uploaded
    if (isset($_FILES["post_image"]) && $_FILES["post_image"]["error"] === 0) {
        $imageFileName = $_FILES["post_image"]["name"];
        $imageTempPath = $_FILES["post_image"]["tmp_name"];
        $imageUploadPath = "uploads/" . basename($imageFileName);

        // Move the uploaded image to a folder (you need to create the "uploads" folder)
        if (move_uploaded_file($imageTempPath, $imageUploadPath)) {
            // Image upload successful, save the post data to the database with image file path
            $query = "INSERT INTO wp_sk_posts (post_content, post_image) VALUES ('$postContent', '$imageUploadPath')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Post saved successfully
                // Redirect back to the user_front_view.php page
                header("Location: user_front_view.php");
                exit(); // Ensure that code execution stops here
            } else {
                // Failed to save the post
                echo "Error: " . mysqli_error($connection);
            }
        } else {
            // Failed to move the uploaded image
            echo "Error uploading image!";
        }
    } else {
        // No image uploaded, save the post data without an image
        $query = "INSERT INTO wp_sk_posts (post_content) VALUES ('$postContent')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Post saved successfully
            // Redirect back to the user_front_view.php page
            header("Location: user_front_view.php");
            exit(); // Ensure that code execution stops here
        } else {
            // Failed to save the post
            echo "Error: " . mysqli_error($connection);
        }
    }

    // Don't forget to close the database connection
    mysqli_close($connection);
}
?>
