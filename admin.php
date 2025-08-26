<?php
include 'connect.php';

$uploadMessage = '';
session_start();

    if(isset($_SESSION['user_id'])) {
        include 'header.php'; 

if (isset($_FILES['Movie'])) {
    $target = 'uploads/' . basename($_FILES['Movie']['name']);
    $target2 = 'uploads/' . basename($_FILES['movie_image']['name']);

    if (move_uploaded_file($_FILES['Movie']['tmp_name'], $target) && move_uploaded_file($_FILES['movie_image']['tmp_name'], $target2)) {
        $movie_title = mysqli_real_escape_string($pdo, $_POST['movie_title']);
        $movie_description = mysqli_real_escape_string($pdo, $_POST['movie_description']);
        $year = mysqli_real_escape_string($pdo, $_POST['run_time']);
        $category = mysqli_real_escape_string($pdo, $_POST['category']);
        $movie_image = mysqli_real_escape_string($pdo, $_FILES['movie_image']['name']);
        $Movie = mysqli_real_escape_string($pdo, $_FILES['Movie']['name']);

        $insertq = "INSERT INTO `movies`(`title`, `description`, `image`,`category`, `year`, `video`) 
                    VALUES ('$movie_title', '$movie_description', '$movie_image', '$category', '$year', '$Movie')";
                    mysqli_query($pdo, $insertq);
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Movie - Netflix Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css " />
    <style>

        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
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
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="upper">
    <h2>Upload a Movie</h2><br>

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
        <input type="text" name="category" placeholder="Enter category" required>
</div>
<div class="form-group">
        <label for="title">Year:</label>
        <input type="text" name="run_time" placeholder="Enter year" required>
</div>
<div class="form-group">
        <label for="form-group">Poster Image:</label>
        <input type="file" name="movie_image" accept="image/*" required>
</div>
<div class="form-group file-input">
        <label for="form-group">Video File:</label>
        <input type="file" name="Movie" accept="video/*" required>
</div>
        <input type="submit" class="submit-btn" value="Upload Movie">
    </form>
</div>
</body>
</html>
<?php } ?>