<?php
include 'config.php';
include 'header.php';
?>

<main>
    <section class="hero" style="background-image: url('images/ipl.avif'); ">
        <div class="hero-content">
            <h1>Welcome to JioHotstar</h1>
            <p>Stream your favorite movies, TV shows, and sports</p>
            <a href="signup.php" class="btn-subscribe">Subscribe Now</a>
        </div>
    </section>

    <section class="content-section">
        <h2>Recommended For You</h2>
        <div class="content-grid">
            <?php
            $query = "SELECT * FROM videos  WHERE category='movie' LIMIT 6";
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

    <section class="content-section">
        <h2>Popular Series</h2>
        <div class="content-grid">
            <?php
            $query = "SELECT * FROM videos WHERE category='tvshow' LIMIT 6";
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