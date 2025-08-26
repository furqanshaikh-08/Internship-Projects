
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>title-card</title>
<?php
session_start();
include "config.php";
$id=$_GET['id'];
	if(isset($_SESSION['user_id'])) {
		include 'header.php'; 
	
	$stmt = $pdo->query("SELECT * FROM movies where id=$id");
$movies = $stmt->fetchAll();
?>
<style>
body{
	background-color: black;
}
.container{
	display: flex;
	align-items: center;
	justify-content: center;
}

.text{
    color:white;
	font-size: 20px;
	padding-left: 30px;
}
button{
	cursor: pointer;
 	color:red;
 	outline:none;
 	border: none;
 	font-weight: 700;
 	border-radius: 0.2vw;
 	padding-left:2rem;
 	padding-right:2rem ;
 	margin-right: 1rem;
 	padding-top:0.5rem;
 	padding-bottom: 0.5rem;
 	background-color: rgba(51,51,51,0.5);
}
.imgo{
	padding-top: 120px;
	padding-left: 30px;
	padding-right: 20px;
}
</style>
</head>
<main>
	<?php foreach($movies as $movie): ?> 
<div class="container">
	<div class="image">
		<img class="imgo" src="images/movies/<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>" height="600" width="400">
	</div>
	
<div class="text">
	<h1 style="color:red;"><?php echo $movie['title']; ?></h1><br>
	<h3><?php echo $movie['description']?></h3><br>
	<a href="video.php?id=<?php echo $id; ?>" <p><button>Play</button></p></a>
</div>
</div>
<?php endforeach; ?>
</main>
</html>
<?php } ?>
