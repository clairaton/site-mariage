<?php
include_once ('header.php');
$stmt=$db->query('SELECT pic_album FROM pictures GROUP BY pic_album');
$albums=$stmt->fetchAll();
?>
<div id="before">
</div>
<?php
if($log){ ?>
	<h2>Albums Photo</h2>
	<p class="intro">Une fois la fête finie, n'hésitez pas à revenir sur cette page afin de revivre les meilleurs moments en photos et pour nous envoyer vos clichés.</p>
	<div class="panneau"><?php
		foreach($albums as $album){ ?>
		<div class= album>
				<?php
				$stmt=$db->prepare('SELECT * FROM pictures WHERE pic_album =:album ORDER BY RAND() LIMIT 1');
				$stmt->bindValue('album',$album['pic_album'],PDO::PARAM_STR);
				$stmt->execute();
				$thumb= $stmt->fetch(); ?>
			<a href="portfolio.php?album=<?= $album['pic_album'] ?>" alt="accès à la galerie d'images" title="accès à la galerie d'images">
				<div class="thumb"><img src="<?=$thumb['pic_url']?>" id="<?=$thumb['pic_id']?>"></div>
				<?php
				$stmt=$db->prepare('SELECT * FROM pictures WHERE pic_album =:album and pic_id != :thumb ORDER BY RAND() LIMIT 3');
				$stmt->bindValue('album',$album['pic_album'],PDO::PARAM_STR);
				$stmt->bindValue('thumb',$thumb['pic_id'],PDO::PARAM_STR);
				$stmt->execute();
				$smalls= $stmt->fetchAll(); 
				foreach($smalls as $small){ ?>
				<div class="small-thumb"><img src="<?=$small['pic_url']?>" id="<?=$small['pic_id']?>"></div>
				<?php	} ?>
				<h3><?=$album['pic_album']?></h3>
			</a>
		</div>
		<?php }
	echo '</div>';
}
else{ ?>
<h3>Vous devez vous connecter pour accéder au contenu de cette page</h3>
<p>Vous allez être redirigé vers l'acceuil</p>
<?php
	header('Location:index.php');
	exit();
}

include_once ('footer.php');
