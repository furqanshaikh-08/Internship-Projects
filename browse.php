<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch movies from database
$stmt = $pdo->query("SELECT * FROM movies ORDER BY RAND() LIMIT 20");
$movies = $stmt->fetchAll();
?>

<?php include 'header.php'; ?>

<main class="browse-container">
    <section class="hero-banner" style="background-image: url('images/movies/hero-banner.jpg');">
        <div class="hero-content">
            <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
            <div class="hero-buttons">
            
           <a href="mtrail.mp4" <button class="btn-play" ><i class="fas fa-play"></i> Play</button></a>
              
                <button class="btn-info"><i class="fas fa-info-circle"></i> More Info</button>
            </div>
        </div>
    </section>

    <section class="movie-rows"><br>
        <h2 class="row-title">Popular on Netflix</h2>
        <div class="movie-row">
            <?php foreach($movies as $movie): ?>
                <div class="movie-item">
                    <img src="images/movies/<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
                    <div class="movie-overlay">
                        <h3><?php echo $movie['title']; ?></h3>
                        <div class="movie-actions">
                          <a href="card.php?id=<?php echo $movie['id'];?>" <button class="btn-play-sm"><i class="fas fa-play"></i></button> </a>
                            <button class="btn-add"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>