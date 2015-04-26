<?php
include('header.php');

$mic=false;
$projecteur=false;
$name='';
$mail='';
$error=false;
$errors=array();
$send=false;

if(!empty($_POST)){
//on vérifie qu'il n'y pas d'erreur de saisie

	if(!empty($_POST['speech_name'])){
		$name=$_POST['speech_name'];
	}
	else{
		$errors['name']="N'oubliez pas de renseigner le nom des participants!";
	}
	if(!empty($_POST['speech_mail'])){
		$mail=$_POST['speech_mail'];
	}
	else{
		$errors['mail']="N\'oubliez pas de renseigner le mail de contact";
	}
	if($_POST['speech_mic']){
		$mic=true;
	}
	if($_POST['speech_projecteur']){
		$projecteur=true;
	}
	// on crée une requête d'insertion
	if(!$error){
		$stmt=$db->prepare('INSERT INTO speech (speech_names,speech_mail,speech_projector,speech_mic) VALUES (:name,:mail,:projecteur,:mic)');
		$stmt-> bindValue('name',$name,PDO::PARAM_STR);
		$stmt-> bindValue('mail',$mail,PDO::PARAM_STR);
		$stmt-> bindValue('mic',$mic,PDO::PARAM_STR);
		$stmt-> bindValue('projecteur',$projecteur,PDO::PARAM_STR);
		$stmt-> execute();
		$new_music=$db->fetchAll();

		$send=true;
	}
}
if($log=="logged"){ ?>
<div id="before">
</div>
<h2>Discours</h2>
<p class="intro">Si vous souhaitez effectuer une intervention lors de la soirée (discours, chanson...), dîtes le nous, cela nous permettra de planifier au mieux la soirée.</p>
<div class="box">
	<h4><?= strtoupper('Inscrire une intervention') ?></h4>
	<form action="discours.php" method="POST" class="inside" novalidate>
		<label>Noms des participants :
			<input type="text" name="speech_name" placeholder="nom du (des) participant(s)"  >
		</label>
		<div class="ckeck">Equipement requis :
			<input type="checkbox" name="speech_projecteur" value="true"> projecteur
			<input type="checkbox" name="speech_mic" value="true"> micro
		</div>
		<label>Mail de contact :
			<input type="email" name="speech_mail" placeholder="mail de contact"  >
		</label>
		<button type="submit">Envoyer</button>
	</form>
</div>

<?php
}
else{
	header('Location:index.php');
	exit();
}
include('footer.php');