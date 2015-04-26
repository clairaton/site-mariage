<?php
include('header.php');

$error=false;
	$errors=array();
	$send=false;
	if(!empty($_POST)){
		//on vérifie qu'il n'y pas d'erreur de saisie

		if(!empty($_POST['music_title'])){
			$title=$_POST['music_title'];
		}
		else{
			$errors['title']="N'oubliez pas de renseigner le titre!";
		}
		if(!empty($_POST['music_author'])){
			$author=$_POST['music_author'];
		}
		else{
			$errors['author']="N\'oubliez pas de renseigner l\'auteur";
		}
		// on crée une requête d'insertion
		if(!$error){
			$stmt=$db->prepare('INSERT INTO music (music_song,music_author) VALUES (:music_song,:music_author)');
			$stmt-> bindValue('music_song',$music_song,PDO::PARAM_STR);
			$stmt-> bindValue('music_author',$music_author,PDO::PARAM_STR);
			$stmt-> execute();
			$new_music=$db->fetchAll();

			$send=true;
		}
	}
if($log=="logged"){
?>
<div id="before">
</div>
<h2>Musique</h2>
<p class="intro">Aidez nous à soumettre une liste de titres entraînants pour la soirée, envoyez-nous les titres des musiques qui vous font bouger !</p>
<div class="box">
	<h4><?= strtoupper('Chanson a integrer dans la playlist').':' ?></h4>
	<form action="music.php" method="POST" class="inside" novalidate>
		<label>Titre :
			<input type="text" name="music_song" placeholder="Titre de la chanson">
		</label>

		<label>Auteur :
			<input type="" name="music_author" placeholder="Auteur" >
		</label>

		<button type="submit">Envoyer</button>
	</form>
	<?= $send?'<p>Votre titre a bien été envoyé!':'';?></p>
</div>
<?php
}
else{
	header('Location:index.php');
	exit();
}
include('footer.php');
