<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
else{

// Get user's profiles
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$profiles = $stmt->fetchAll();

// Handle profile selection
if(isset($_GET['profile_id'])) {
    $profile_id = $_GET['profile_id'];
    
    // Verify the profile belongs to the user
    $stmt = $pdo->prepare("SELECT id FROM profiles WHERE id = ? AND user_id = ?");
    $stmt->execute([$profile_id, $_SESSION['user_id']]);
    
    if($stmt->rowCount() > 0) {
        $_SESSION['profile_id'] = $profile_id;
        header("Location: browse.php");
        exit();
    } else {
        $error = "Invalid profile selection";
    }
}
?>

<?php include 'header.php'; ?>

<main class="profiles-container">
    <div class="profiles-header">
        <h1>Who's watching?</h1>
    </div>
    
    <div class="profiles-list">
        <?php foreach($profiles as $profile): ?>
            <a href="profiles.php?profile_id=<?php echo $profile['id']; ?>" class="profile-item">
                <div class="profile-avatar">
                    <img src="images/movies/<?php echo $profile['avatar']; ?>" alt="<?php echo $profile['name']; ?>">
                </div>
                <div class="profile-name"><?php echo $profile['name']; ?></div>
            </a>
        <?php endforeach; ?>
        
        <?php if(count($profiles) < 5): ?>
            <a href="create_profile.php" class="profile-item add-profile">
                <div class="profile-avatar">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="profile-name">Add Profile</div>
            </a>
        <?php endif; ?>
    </div>
    
    <div class="profile-actions">
        <a href="edit_profile.php" class="btn-edit">Manage Profiles</a>
    </div>
</main>

<?php include 'footer.php';} ?>