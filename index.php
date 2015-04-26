<?php
include_once('header.php');


 $fields=array(
 	'lastname' => array(
 		'required' => true,
 		'type' => 'text',
 		'name' => 'nom',
 		'placeholder' => 'Nom'),
 	'firstname' => array(
 		'required' => true,
 		'type' => 'text',
 		'name' => 'prenom',
 		'placeholder' => 'Prénom'),
 	'email' => array(
 		'required' => true,
 		'type' => 'text',
 		'name' => 'email',
 		'placeholder' => 'E-mail'),
 	'participation' => array(
 		'required' => true,
 		'type' => 'radio',
 		'name' => 'response',
 		'placeholder' => 'participation')
 );

 //on initialise les variable d'erreur
$thanks='';
$errors=array();
$msg='';

 foreach($fields as $key => $value){
 	$$key ='';
 }
 if(!empty($_POST)){
 	if(!empty($_POST['log']) && $_POST['log'] == "cécile-samy"){
		$log="logged";
		$_SESSION['log']="logged";
		$msg="A l'issue de la cérémonie, nous aurons le plaisir de vous accueillir<br /> pour un cocktail servi à Agnetz Cottage.";
		header ('Location:index.php');
	}
 	else if(!empty($_POST['log']) && $_POST['log'] == "12/09/2015"){
		$log="logged";
		$_SESSION['log']="logged";
		$msg="A l'issue de la cérémonie, nous aurons le plaisir de vous accueillir<br /> pour un cocktail servi à Agnetz Cottage suivi d'un dîner.";
		header ('Location:index.php');
	}
	else{
	 	foreach($fields as $key => $value){
	 		 if(empty($_POST[$value['name']]) && $value['required']){
	 		 	$errors['$key']="Le champs ".$value['placeholder']." est obligatoire";
	 		}
	 		else if($value['type'] == 'email' && !filter_var($_POST[$value['name']], FILTER_VALIDATE_EMAIL)){
	 			$errors['$key']="Attention, ce n'est pas un email valide!";
	 		}
	 		$$key = $_POST[$value['name']];
	 	}
	 	if(empty($errors)){
	 		$stmt = $db ->prepare('INSERT INTO rsvp (lastname,firstname,email,participation) VALUES(:lastname,:firstname,:email,:participation)');
	 		foreach($fields as $key => $value){
	 			$stmt -> bindValue($key,$$key,PDO::PARAM_STR);
	 		}
	 		$stmt -> execute();
	 		$new_response=$db -> lastInsertId();
	 		if(!empty($new_response)){
	 			$thanks = "Merci pour votre réponse !";
	 		}
	 	}
	}

 }
?>
<div id="before">
</div>
<div id="pres">
	<div id="pic">
	</div>
	<p>Nous avons la joie de vous faire part de notre mariage qui sera c&eacute;l&eacute;br&eacute; le<br /> samedi <strong>12 septembre 2015</strong>,<br /> à <strong>15 h 30</strong><br /> en l'église Saint Léger d'Agnetz.</p>
	<div id="invite"><?= $msg ?></div>
</div>
<?php
// on vérfie que la variable de session sur la log est sur true
if($log=="logged"){
?>
<form id="formRsvp" action="index.php" method="POST" novalidate>
<h3>Réponse souhaitée<br /> avant le <strong>15 juillet 2015</strong></h3>
	<label>Nom:
		<input type="text" name="nom" placeholder="Nom" class="nom" />
	</label>
	<label>Pr&eacute;nom(s):
		<input type="text" name="prenom" placeholder="Pr&eacute;nom(s)" class="prenoms" />
	</label>
	<label>E-mail:
		<input type="email" name="email" placeholder="E-mail" />
	</label>
	<div>
		<label>
			<input type="radio" name="response" id="participe" value="yes"/>Sera (seront) pr&eacute;sent(s)
		</label>
		<label>
			<input type="radio" name="response" id="absent" value="no"/>Ne sera (seront) <strong>pas</strong> pr&eacute;sent(s)
		</label>
	</div>
	<button type="submit">Envoyer</button>
</form>

<div id="programme">
	<h3>Programme de la journée</h3>
	<div class="heure">
		<div>12 Sept.<div>15h30</div></div>
		<h4>Célébration de mariage </h4>
		<p>Eglise d'Agnetz</p>
	</div>
	<div class="heure white">
		<div>12 Sept.<div>17h00</div></div>
		<h4>Cocktail franco-mauricien</h4>
		<p>Agnetz Cottage</p>
	</div>
	<div class="heure">
		<div>12 Sept.<div>20h00</div></div>
		<h4>Diner et soirée dansante</h4>
		<p>Agnetz Cottage</p>
	</div>
	<div class="heure">
		<div>13 Sept.<div>11h00</div></div>
		<h4>Brunch</h4>
		<p>Agnetz Cottage</p>
	</div>

</div>
<?php }
else{
	// j'affiche par défaut la fenêtre de connection
?>
<form id="connect" action='index.php' method='POST'>
	<h2>Connectez-vous</h2>
	<label>Mot de passe:
		<input type="text" id="log" name="log">
	</label>
	<button type="submit">Valider</button>
</form>
<?php
}
include_once('footer.php');