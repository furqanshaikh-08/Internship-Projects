<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="netflixlogo.jpg" alt="Netflix Clone">
                </a>
            </div>
            <div class="nav-links">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="browse.php" class="nav-link">Home</a>
                    <a href="#" class="nav-link">TV Shows</a>
                    <a href="#" class="nav-link">Movies</a>
                    <a href="#" class="nav-link">New & Popular</a>
                    <a href="admin.php" class="nav-link">Upload</a>
                    <a href="logout.php" class="nav-link">Sign Out</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Sign In</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>