<?php 
session_start();
include "config.php";

	if(isset($_SESSION['user_id'])) {
include "header.php";
$id=$_GET['id'];
$stmt = $pdo->query("SELECT video FROM movies where id=$id");
$movies = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>video</title>
	<style>
	video{
		margin-top:200px;
	  height: 380;
	  width: 280;
	}
	</style>

</head>
<body >
	<center>
		<?php foreach($movies as $movie): ?> 
<video  controls> 
            <source src="videos/<?php echo $movie['video']?>" type="video/mp4">
     </video>
     <?php endforeach; ?>
     </center>
</body>
</html>
<?php } ?>