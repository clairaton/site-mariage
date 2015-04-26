<?php
// j'initialise une session avec le name wedding_cilou_samy
session_name('mariage_samy_cecile');
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);

// on vérifie que l'utilisateur a bien accès au contenu protégé
$log="";
if(!empty($_SESSION['log'])){
	$log=$_SESSION['log'];
}

include_once ('inc/db.php');
if($log=="logged"){
	$album='aperçu';
	if(!empty($_GET['album'])){
		// on stocke la valeur de l'album dans une variable
		$album=$_GET['album'];
		// on crée une requête PDO pour aller chercher les photos
		$stmt=$db->prepare('SELECT * FROM pictures WHERE pic_album= :album');
		$stmt->bindValue('album',$album,PDO::PARAM_STR);
		$stmt->execute();
		$pictures=$stmt-> fetchAll();
		//si l'album n'existe pas dans notre base de donnée
		if(empty($pictures)){
			// on affiche l'album par défault
			$album='aperçu';
			// on crée une requête PDO pour aller chercher les photos
			$stmt=$db->prepare('SELECT * FROM pictures WHERE pic_album= :album');
			$stmt->bindValue('album',$album,PDO::PARAM_STR);
			$stmt->execute();
			$pictures=$stmt-> fetchAll();
		}
	}
	?>
<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset="utf8">
	        <title>Mariage Cécile &amp; Samy</title>
	        <link rel="stylesheet" href="css/pics.css">
	    </head>
		<body>
			<div id="nav-icone" class="left">
				<h3>Menu</h3>
			</div>
			<div id="slider">
				<?php
				$i=0;
				// on crée une boucle pour intégrer l'ensemble des photos du diaporama
				foreach($pictures as $picture){	?>
				<img src="<?=$picture['pic_url']?>" alt="photo mariage" class="<?=++$i?>">
				<?php } ?>
			</div>
			<div id="thumbnails">
				<img class="left thumb" src="img/fleche_gauche.png">
				<img class="right thumb" src="img/fleche_droite.png">
				<?php
				/* on crée une boucle pour afficher les miniatures
				$i=0;
				foreach($pictures as $picture){?>
				<img class="thumb"src="<?=$picture['pic_url']?>" alt="photo mariage" id="<?=++$i?>">
				<?php } */?>

			</div>
			<script src="js/jquery.js"></script>
			<script src="js/carousel.js"></script>
		</body>
	</html>
	<?php
}
else{
	header('Location:index.php');
	exit();
}
