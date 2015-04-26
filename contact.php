<?php
include('header.php');
?>
<div id="before">
</div>
<?php
if($log == "logged"){
?>
<h2>Contacts</h2>
<h3>Des questions? Besoin d'aide?</h3>
<p>Vous trouverez ici toutes les informations nécessaires pour joindre</p>
<div class="contact">
	<h3>Cécile</h3>
	<h4>Phone:</h4>
	<p>06 22 68 91 49</p>
	<h4>Email:</h4>
	<p>ce.ansart@gmail.com </p>
</div>
<div class="contact">
	<h3>Samy</h3>
	<h4>Phone:</h4>
	<p>06 66 66 66 66</p>
	<h4>Email:</h4>
	<p>samy.lutchmanen@gmail.com</p>
</div>
<div class="contact middle">
	<h3>Stéphanie</h3>
	<h4>Phone:</h4>
	<p>06 10 45 69 65</p>
	<h4>Email:</h4>
	<p>steph.ansart@orange.fr </p>
</div>

<?php
}
else{ ?>
<h3>Vous devez vous connecter pour accéder au contenu de cette page</h3>
<p>Vous allez être redirigé vers l'acceuil</p>
<?php
	header('Location:index.php');
	exit();
}
include('footer.php');