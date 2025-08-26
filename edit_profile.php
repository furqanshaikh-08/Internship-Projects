<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user's profiles
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$profiles = $stmt->fetchAll();

// Handle delete request
if(isset($_GET['delete'])) {
    $profile_id = $_GET['delete'];
    
    // Verify the profile belongs to the user
    $stmt = $pdo->prepare("SELECT id FROM profiles WHERE id = ? AND user_id = ?");
    $stmt->execute([$profile_id, $_SESSION['user_id']]);
    
    if($stmt->rowCount() > 0) {
        // Delete profile (foreign key constraints will handle preferences)
        $stmt = $pdo->prepare("DELETE FROM profiles WHERE id = ?");
        $stmt->execute([$profile_id]);
        
        // If deleting the currently selected profile, unset it
        if(isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == $profile_id) {
            unset($_SESSION['profile_id']);
        }
        
        header("Location: edit_profile.php");
        exit();
    }
}
?>

<?php include 'header.php'; ?>

<main class="edit-profiles-container">
    <div class="edit-profiles-header">
        <h1>Manage Profiles</h1>
        <p>Edit or delete profiles for this account.</p>
    </div>
    
    <div class="profiles-list">
        <?php foreach($profiles as $profile): ?>
            <div class="profile-item">
                <a href="update_profile.php?id=<?php echo $profile['id']; ?>" class="profile-avatar">
                    <img src="images/movies/<?php echo $profile['avatar']; ?>" alt="<?php echo $profile['name']; ?>">
                </a>
                <div class="profile-name"><?php echo $profile['name']; ?></div>
                <div class="profile-actions">
                    <a href="update_profile.php?id=<?php echo $profile['id']; ?>" class="btn-edit">Edit</a>
                    <a href="edit_profile.php?delete=<?php echo $profile['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                </div>
            </div>
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
        <a href="profiles.php" class="btn-done">Done</a>
    </div>
</main>

<?php include 'footer.php'; ?>