<?php
// j'initialise une session avec le name wedding_cilou_samy
session_name('mariage_samy_cecile');
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf8">
        <title>Mariage Cécile &amp; Samy</title>
        <link rel="stylesheet" href="css/base.css">
    </head>
	<body>
		<header>
			<div class="container">
				<div id="compteur">
					<h3><span id="day"></span></h3>
				</div>
				<div class="maries teaser">
					<h2>C&eacute;cile</h2>
				</div>
				<div id="union" class="teaser"> &amp; </div>
				<div class="maries teaser">
					<h2>Samy</h2>
				</div>
				<div id="date">
					<h1>12 septembre 2015</h1>
				</div>

			</div>
		</header>
<?php
include 'nav.php';
?>
		<main>
			<div class="container">