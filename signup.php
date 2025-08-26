<?php
include 'config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Email already registered";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            header('Location: index.php');
            exit();
        } else {
            $error = "Registration failed: " . mysqli_error($conn);
        }
    }
}
?>

<main class="auth-page">
    <div class="auth-container">
        <h2>Create Account</h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-subscribe">Sign Up</button>
        </form>
        <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>