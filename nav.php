<?php
// on vérifie que l'utilisateur a bien accès au contenu protégé
$log="";
if(!empty($_SESSION['log'])){
	$log=$_SESSION['log'];
}

$currentPage = basename($_SERVER['PHP_SELF']);

include_once ('inc/db.php');
//include_once ('inc/func.php');

//On crée un tableau repertoriant les liens du menu
$pages=array(
	'index.php'=> array(
		'name' => 'Accueil',
		'autorisation' => 'open'),
	'pratique.php' => array(
		'name' =>'Infos pratiques',
		'autorisation' => 'locked'),
	'liste.php'=> array(
		'name' =>'Liste de Mariage',
		'autorisation' => 'open'),
	'contact.php'=> array(
		'name'=>'Contact',
		'autorisation' => 'locked'),
	'photo.php'=> array(
		'name' => 'Photos',
		'autorisation' => 'locked')
	);
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

?><nav>
			<div class="container">
				<ul>
					<?php
					foreach($pages as $key=>$values){
						$active=($key == $currentPage)? 'active':'';
						if($log !== "logged" && $values['autorisation'] == "locked" && !$ajax){?>
						<li>
							<a class="locked <?= $active?>"><?= $values['name'] ?></a>
						</li>
					<?php }
						else{ ?>
						<li>
							<a href="<?= $key ?>" class="open <?= $active?>"><?= $values['name'] ?></a>
						</li>
						<?php }
						}?>
				</ul>
			</div>
		</nav>