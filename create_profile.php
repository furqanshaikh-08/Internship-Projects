<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check max profiles (Netflix allows 5 per account)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM profiles WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$profile_count = $stmt->fetchColumn();
$pin=123;
if($profile_count >= 5) {
    header("Location: profiles.php");
    exit();
}

$error = '';
$avatars = [
    'avatar1.png', 'avatar2.png', 'avatar3.png', 
    'avatar4.png', 'avatar5.png', 'avatar6.png'
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $avatar = $_POST['avatar'];
    
    // Validate
    if(empty($name)) {
        $error = "Profile name is required";
    } elseif(strlen($name) > 50) {
        $error = "Profile name must be 50 characters or less";
    } else {
        // Check if name already exists for this user
        $stmt = $pdo->prepare("SELECT id FROM profiles WHERE user_id = ? AND name = ?");
        $stmt->execute([$_SESSION['user_id'], $name]);
        $is_child=null;
        if($stmt->rowCount() > 0) {
            $error = "You already have a profile with this name";
        } else {
            // Create profile
            $stmt = $pdo->prepare("INSERT INTO profiles (user_id, name, avatar, pin) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $name, $avatar, $pin]);
            
            // Create default preferences
            $profile_id = $pdo->lastInsertId();
            $stmt = $pdo->prepare("INSERT INTO user_preferences (profile_id) VALUES (?)");
            $stmt->execute([$profile_id]);
            
            header("Location: profiles.php");
            exit();
        }
    }
}
?>

<?php include 'header.php'; ?>

<main class="create-profile-container">
    <div class="create-profile-form">
        <h1>Add Profile</h1>
        <p>Add a profile for another person watching Netflix.</p>
        
        <?php if(!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="create_profile.php" method="post">
            <div class="avatar-selection">
                <h3>Choose an avatar:</h3>
                <div class="avatars-grid">
                    <?php foreach($avatars as $avatar): ?>
                        <label class="avatar-option">
                            <input type="radio" name="avatar" value="<?php echo $avatar; ?>" required>
                            <img src="images/movies/<?php echo $avatar; ?>" alt="Avatar">
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="form-group">
                <input type="text" name="name" placeholder="Profile name" required maxlength="50">
            </div>
            
            
            <button type="submit" class="btn">Save</button>
            <a href="profiles.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>