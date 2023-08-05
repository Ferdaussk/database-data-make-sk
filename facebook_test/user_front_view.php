<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Front View - Facebook-like Social Media</title>
    <link rel="stylesheet" href="user_front.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4267B2;
            color: white;
            padding: 10px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-profile h2 {
            margin: 0;
            font-size: 24px;
        }

        .post {
            margin: 20px 0;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .post h3 {
            margin: 0;
            font-size: 18px;
        }

        .post p {
            margin: 10px 0;
        }

        .friends-list {
            list-style: none;
            padding: 0;
        }

        .friends-list li {
            margin-bottom: 5px;
        }

        .notifications {
            list-style: none;
            padding: 0;
        }

        .notifications li {
            margin-bottom: 5px;
        }
        /* Add more styles as needed */

    </style>
</head>
<body>
    <header>
        <h1>A Social Media</h1>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </header>

    <div class="container">
        <!-- User profile in top (Start) -->
        <div class="area_of_profile">
            <div class="for_profile_image">
                <img src="" alt="img" srcset="">
            </div>
            <?php
            include('database.php');
            $userId = 1; // Replace with the actual user ID of the logged-in user
            $query = "SELECT first_name, last_name FROM wp_sk_users WHERE id = $userId";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                $firstName = $userData['first_name'];
                $lastName = $userData['last_name'];
                echo '<h2 class="show_full_name">' . $firstName . ' ' . $lastName . '</h2>';
            } else {
                echo '<h2 class="show_full_name">User Full Name</h2>'; // Default value if user data is not found
            }
            // here i can see just one name but i wanted here show current user name
            ?>
        </div>
        <!-- User profile in top (End) -->


        <!-- Create new posts (Start) -->
        <button class="create_a_new_post">Create Posts</button>
        <!-- Popup content -->
        <div class="popup-overlay"></div>
        <div class="popup-content">
            <h3>Create a New Post</h3>
            <form action="submit_post.php" method="post" enctype="multipart/form-data">
                <label for="post_content">Post Content:</label>
                <textarea id="post_content" name="post_content" rows="4" required></textarea>
                <br>
                <label for="post_image">Upload Image:</label>
                <input type="file" id="post_image" name="post_image">
                <br>
                <button type="submit" id="submitPost">Submit</button>
            </form>
            <button id="closePopup">Close</button>
        </div>
        <!-- Create new posts (End) -->
        <!-- make a new database sql and save the post_content and post_image in the database -->


        <div class="all_post_show_here_wrap">
        <?php
        // Connect to the database (replace with your own database credentials)
        include('database.php');

        // Retrieve all posts from the database
        $query = "SELECT * FROM wp_sk_posts";
        $result = mysqli_query($connection, $query);

        // Loop through each post and display its content and image
        while ($post = mysqli_fetch_assoc($result)) {
            $postContent = $post['post_content'];
            $postImage = $post['post_image'];

            echo '<div class="post_loop post">';
            echo '<p class="show_post_content">' . $postContent . '</p>';
            if (!empty($postImage)) {
                echo '<img src="' . $postImage . '" id="show_post_image" alt="img" srcset="" width="200px">';
            }
            echo '</div>';
        }

        // Don't forget to close the database connection
        mysqli_close($connection);
        ?>
    </div>
        <!-- it's from the redirected page. show the post_content and post_image in here show_post_content and show_post_image from database -->

        <div class="post">
            <h3>Another Post Title</h3>
            <p>Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </div>

        <h3>Friends</h3>
        <ul class="friends-list">
            <li>Friend 1</li>
            <li>Friend 2</li>
            <li>Friend 3</li>
        </ul>

        <h3>Notifications</h3>
        <ul class="notifications">
            <li>You have a new message</li>
            <li>Your post got liked</li>
            <li>Friend request received</li>
        </ul>
    </div>
    <script src="user_front.js"></script>
</body>
</html>
