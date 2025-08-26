<?php
session_start();
include 'config.php';

if(isset($_SESSION['user_id'])) {
    header("Location: browse.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: profiles.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<?php include 'header.php'; ?>
<body style="background-image:url(netflixbg.jpg) ; background-size: cover;">
<main class="auth-container">
    <div class="auth-form" >
        <h1>Sign In</h1>
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
        <div class="auth-links">
            <p>New to Netflix? <a href="signup.php">Sign up now</a>.</p>
        </div>
    </div>
</main>
</body>

<?php include 'footer.php'; ?>