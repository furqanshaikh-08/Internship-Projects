<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JioHotstar Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="images/logo.webp" alt="JioHotstar">
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search movies, shows, sports">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="#">TV</a>
                <a href="#">Movies</a>
                <a href="#">Sports</a>
                <a href="#">Premium</a>
                <a href="admin.php">Admin</a>
            </div>
            <div class="user-actions">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="btn-login">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Login</a>
                <?php endif; ?>
                <a href="signup.php" class="btn-subscribe">Subscribe Now</a>
            </div>
        </nav>
    </header>