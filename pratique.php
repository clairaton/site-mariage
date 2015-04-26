<?php
include('header.php');
if($log="logged"){
?>
<div id="before">
</div>
<div class="panneau">
	<a href="panel.php?title=map" id="mapping" class="pannel">
		<h3>Accès</h3>
		<div class="icone">
			<p>Vous ne connaissez pas encore Agnetz? <br />Vous trouverez ici toutes les indications nécessaires pour vous orienter.</p>
		</div>

	</a>

	<a href="panel.php?title=hotel" id="hotel" class="pannel">
		<h3>Hôtel</h3>
		<div class="icone">
			<p>Besoin d'un logement? <br />Pas d'inquiétudes nous avons ce qu'il faut à proximité...</p>
		</div>
	</a>
</div>
<div class="panneau2" >
	<a href="music.php" id="musique" class="pannel">
		<h3>Musique</h3>
		<div class="icone">
			<p>Qui dit soirée dansante, dit musique! <br />Aidez nous à orienter la playlist.</p>
		</div>
	</a>
	<a href="discours.php" id="discours" class="pannel">
		<h3>Discours</h3>
		<div class="icone">
			<p>Les mariages à la française sont ponctués de discours, <br />Aidez nous à organiser le planning des animations.</p>
		</div>
	</a>
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