<?php
include 'config.php';

$uploadMessage = '';

if (isset($_FILES['Movie'])) {
    $target = 'uploads/' . basename($_FILES['Movie']['name']);
    $target2 = 'uploads/' . basename($_FILES['movie_image']['name']);

    if (move_uploaded_file($_FILES['Movie']['tmp_name'], $target) && move_uploaded_file($_FILES['movie_image']['tmp_name'], $target2)) {
        $movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
        $movie_description = mysqli_real_escape_string($conn, $_POST['movie_description']);
        $year = mysqli_real_escape_string($conn, $_POST['run_time']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $movie_image = mysqli_real_escape_string($conn, $_FILES['movie_image']['name']);
        $Movie = mysqli_real_escape_string($conn, $_FILES['Movie']['name']);
        $rating=mysqli_real_escape_string($conn, $_POST['rating']);
        $duration=mysqli_real_escape_string($conn, $_POST['duration']);
        $insertq = "INSERT INTO `videos`(`title`, `description`,`category`, `thumbnail`,`video_file`, `year`, `duration`,`rating`) 
                    VALUES ('$movie_title', '$movie_description','$category', '$movie_image','$Movie','$year','$duration','$rating')";
                    mysqli_query($conn, $insertq);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Movie - JioHotstar Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>

       
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color:whitesmoke;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
            background-color: #111;
            color:white;
        }
        .file-input {
            margin: 15px 0;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        .success {
            color: green;
            margin-top: 5px;
        }
        .upper{
            margin-top: 50px;
             font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body style="background-color: #111;">
    <?php include 'header.php' ?>
<div class="upper">
    <h2 style="color:white;">Upload a Movie</h2><br>

    <?php echo $uploadMessage; ?>

    <form action="admin.php" method="POST" enctype="multipart/form-data">
     <div class="form-group">
        <label for="title">Movie Title:</label>
        <input type="text" name="movie_title" placeholder="Enter movie title" required>
</div>
<div class="form-group">
        <label for="description">Description:</label>
        <textarea name="movie_description" placeholder="Enter description..." required></textarea>
</div>
<div class="form-group">
        <label for="title">Category:</label>
        <input type="text" name="category" placeholder="movie/tvshow/sports" required>
</div>
<div class="form-group">
        <label for="form-group">Poster Image:</label>
        <input type="file" name="movie_image" accept="image/*" required>
</div>
<div class="form-group file-input">
        <label for="form-group">Video File:</label>
        <input type="file" name="Movie" accept="video/*" required>
</div>
<div class="form-group">
        <label for="title">Year:</label>
        <input type="text" name="run_time" placeholder="Enter year" required>
</div>
<div class="form-group">
        <label for="title">Duration:</label>
        <input type="text" name="duration" placeholder="Enter duration" required>
</div>
<div class="form-group">
        <label for="title">rating:</label>
        <input type="text" name="rating" placeholder="Enter rating" required>
</div>
        <input type="submit" class="submit-btn" value="Upload Movie">
    </form>
</div>
</body>
</html>
