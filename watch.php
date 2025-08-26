<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$video_id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM videos WHERE id='$video_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$video = mysqli_fetch_assoc($result);
?>

<main class="watch-page">
    <div class="video-container">
        <video controls autoplay>
            <source src="videos/<?php echo $video['video_file']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="video-info">
            <h1><?php echo $video['title']; ?></h1>
            <div class="video-meta">
                <span><?php echo $video['year']; ?></span>
                <span><?php echo $video['duration']; ?></span>
                <span><?php echo $video['rating']; ?> ★</span>
            </div>
            <p><?php echo $video['description']; ?></p>
            <div class="video-actions">
                <button class="btn-watch"><i class="fas fa-play"></i> Watch Now</button>
                <button class="btn-add"><i class="fas fa-plus"></i> Add to List</button>
            </div>
        </div>
    </div>

    <section class="content-section">
        <h2>More Like This</h2>
        <div class="content-grid">
            <?php
            $query = "SELECT * FROM videos WHERE category='{$video['category']}' AND id!='$video_id' LIMIT 4";
            $result = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="content-card">';
                echo '<a href="watch.php?id='.$row['id'].'">';
                echo '<img src="images/'.$row['thumbnail'].'" alt="'.$row['title'].'">';
                echo '<h3>'.$row['title'].'</h3>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>