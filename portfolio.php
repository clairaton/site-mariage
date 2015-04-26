<?php
// j'initialise une session avec le name wedding_cilou_samy
session_name('mariage_samy_cecile');
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);

$prevPage = 'index.php';

if(!empty($_SERVER['HTTP_REFERRER'])){
	$prevPage = $_SERVER['HTTP_REFERRER'];
}


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
	else{
		// on affiche l'album par défault
		$album='aperçu';
		// on crée une requête PDO pour aller chercher les photos
		$stmt=$db->prepare('SELECT * FROM pictures WHERE pic_album= :album');
		$stmt->bindValue('album',$album,PDO::PARAM_STR);
		$stmt->execute();
		$pictures=$stmt-> fetchAll();
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
			<div class="head">
				<div class="btn left">
					<a href="<?= $prevPage ?>" alt="retour"><h3>Retour Albums</h3></a>
				</div>
				<div class="btn right">
					<a href="carousel.php?album=<?= $album ?>" alt="diaporama"><h3>Afficher le diaporama</h3></a>
				</div>
				<h1>Galerie Photos: "<?= $album ?>"</h1>
			</div>
			<div class='container'>
				<div id="gallery">
					<?php
					// on crée une boucle pour intégrer l'ensemble des photos du diaporama
					foreach($pictures as $picture){	?>
					<img src="<?=$picture['pic_url']?>" alt="photo mariage" class="pic">
					<?php } ?>
				</div>
			<div id="info">
				<p>agrandir l'image</p>
			</div>
			</div>

			<script src="js/jquery.js"></script>
			<script src="js/portfolio.js"></script>

		</body>
	</html>
	<?php
}
else{
	header('Location:index.php');
	exit();
}