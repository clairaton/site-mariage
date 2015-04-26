<?php
include('header.php');
$titleP ="";
if(!empty($_GET)){
	$titleP = $_GET['title'];
}
else{
	header ('Location:pratique.php');
}

if($log){ ?>
	<div id="before">
	</div>
	<?php
	if ($titleP == "map"){?>
		<h2>Comment venir?</h2>
			<div  id="car" class="box">
				<h3>En voiture</h3>
				<div id="map-content">
					<div id="map">
			            <p>Plan D'accès google Map </p>
			        </div>
		        	<a href="https://goo.gl/maps/K6YI2" target="_blank">Visualiser la carte sur Google Maps</a>
		        </div>
		        <p>De paris, empruntez l'A1 direction Lille et prenez la sortie 8 - Senlis </p>
		        <p>Rejoignez Agnetz en suivant les directions de Creil et Beauvais.</p>
				<p>Prenez la sortie D151 - Agnetz  et tournez à gauche.</p>
				<p>Ensuite, c'est toujours tout droit jusqu'à Agnetz Cottage et l'église.</p>
				<p>Il ne vous restera qu'à suivre les panneaux indiquant les parkings destinés aux invités du mariage.</p>
		    </div>
		    <div id="train" class="box">
	        	<h3>En train</h3>
				<p>La gare la plus proche se situe à Clermont de l'Oise, sur la ligne Paris-Amiens.</p>
				<p>N'hésitez pas à nous prévenir si vous arrivez en train et à nous donner votre heure d'arrivée afin que nous organisions des transferts depuis la gare.</p>
			</div>
			<div id="plane" class="box">
				<h3>En avion</h3>
				<p>Si vous arrivez de loin, l'aéroport Charles de Gaulles se situe à 45 minutes.</p>
				<p>Vous pourrez ensuite rejoindre Paris en RER et prendre le train comme indiqué au-dessus ou prendre un taxi pour Agnetz.</p>
			</div>
	<?php
	}
	if ($titleP == "hotel"){
		$hotel_list=array(
		'Le Clermontel'=> array(
			'name'=>'Le CLERMOTEL',
			'gamme' => '**+',
			'adresse' => 'Zone Hoteliere 60 Rue Des Buttes <br /> Agnetz OISE 60600 France',
			'image' => 'img/clermotel.jpg',
			'prix_moyen' => '85€',
			'distance'=>'0.8km',
			'reservation'=>'http://reservation-hotel.logishotels.com/jreservit/fichehotel.do?langcode=FR&userid=461391cb0fea2f9be41b180ce59eebbec402&custid=12&hotelid=395&partid=586&specialMode=default'),
		'Hotel AKENA'=> array(
			'name'=>'Hotel AKENA',
			'gamme' => '**',
			'adresse' => '156, rue des Buttes <br /> Agnetz OISE 60600 France',
			'image' => 'img/akena.jpg',
			'prix_moyen' => '45€',
			'distance'=>'1km',
			'reservation'=>'http://loire.book-secure.com/00000001/032/023112/dispopricev2.phtml?clusterName=AKENAHTLAgnetz&cluster=AKENAHTLAgnetz&Hotelnames=AKENAHTLAgnetz&hname=AKENAHTLAgnetz&langue=france&locale=fr_FR&arrivalDateValue=2015-02-17&arrival=2015-02-17&fromyear=2015&frommonth=02&fromday=17&nbdays=1&nbNightsValue=1&adulteresa=1&nbAdultsValue=1&showPromotions=3&redir=BIZ-so5523q0o4&Clusternames=AKENAHTLAgnetz&rt=1424205818')
		);?>
			<h2>Hotel</h2>
			<p>Vous cherchez un hébergement?</p> <p>Nous avons listé ci-dessous les établissements proche du lieu de la noce.</p>
			<div id="commodity" class="box">
			<?php
			foreach($hotel_list as $hotel){?>
			<div class="content_hotel">
				<img src=<?=$hotel['image']?> alt='photo hotel <?=$hotel['name']?>' class="hotel" />
				<div class="descr">
					<h5><?=$hotel['name']?></h5>
					<span><?=$hotel['gamme']?></span>
					<p><?=$hotel['adresse']?></p>
					<span><?=$hotel['distance']?></span>
					<span><?=$hotel['prix_moyen']?></span>
					<a href='<?=$hotel['reservation']?>' class="reservation" target="_blank" >Réserver</a>
				</div>
			</div>

			<?php } ?>
			</div>

	<?php }
}
else{
	header('Location:index.php');
	exit();
}
include('footer.php');