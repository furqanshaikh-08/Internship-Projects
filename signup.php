<?php
session_start();
include 'config.php';

if(isset($_SESSION['user_id'])) {
    header("Location: browse.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if($stmt->rowCount() > 0) {
        $error = "Email already in use";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if($stmt->execute([$name, $email, $password])) {
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            header("Location: browse.php");
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<?php include 'header.php'; ?>
<body style="background-image:url(netflixbg.jpg); background-size: cover; ">
<main class="auth-container">
    <div class="auth-form">
        <h1>Sign Up</h1>
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="signup.php" method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <div class="auth-links">
            <p>Already have an account? <a href="login.php">Sign in now</a>.</p>
        </div>
    </div>
</main>
</body>
<?php include 'footer.php'; ?>