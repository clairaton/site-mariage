/************************
 * 	 	Modules			*
 ************************/


/*
 * Carousel d'images
 */

carousel = {

	/*
	 * Lancement du carousel
	 */
	init: function() {
		console.info("carousel.init")

		// Toutes les 5 sec, on change d'image
		carousel.play()

		// Ecouteurs
		$("#suivant")
			.on("click", carousel.next)
			.on("click", carousel.replay)
		$("#precedent")
			.on("click", carousel.prev)
			.on("click", carousel.replay)

		// Vignettes
		carousel.vignettes()

	},

	/*
	 * Toutes les 5 secondes, on affiche l'image suivante
	 */
	play: function() {
		console.info("carousel.play")

		// « toutes les » ==> setInterval
		carousel.timer = setInterval(carousel.next, 5000)
	},

	/*
	 * Image suivante
	 */
	next: function() {
		console.info("carousel.next")

		// On récupère l'image active
		var image = $("#slider .active")

		// Je récupère le suivant
		var suivant = image.next("img")

		// S'il n'y a pas de suivant, on prend le premier
		if(suivant.length == 0) {
			suivant = $("#slider img:first")
		}

		// Je cache l'ancienne
		image.fadeOut().removeClass("active")

		// J'affiche la nouvelle
		suivant.fadeIn().addClass("active")

	},

	/*
	 * Image précédente
	 */
	prev: function() {
		console.info("carousel.prev")

		// On récupère l'image active
		var image = $("#slider .active")

		// Je récupère le precedent
		var precedent = image.prev()

		// S'il n'y a pas de précédent, on prend le dernier
		if(precedent.length == 0) {
			precedent = $("#slider img:last")
		}

		// Je cache l'ancienne
		image.fadeOut().removeClass("active")

		// J'affiche la nouvelle
		precedent.fadeIn().addClass("active")

	},

	/*
	 * Relance le carousel
	 */
	replay: function() {
		console.info("carousel.replay")

		// J'arrête le setInterval
		clearInterval(carousel.timer)

		// Je relance
		carousel.play()
	},

	/*
	 * Créer les vignettes
	 */
	vignettes: function() {

		// On récupère le conteneur
		var thumbnails = $("#thumbnails")

		// Créer les images
		$("#slider img").each(function() {

			// On crée
			var img = $("<img>",{
				src: this.src
			})

			// On ajoute à #thumbnails
			img.appendTo(thumbnails)

		})

		// Rajoute mon conteneur au body
		thumbnails
			.on("click","img",carousel.monClic)
			.appendTo("body")
	},

	/*
	 * Clic sur mes vignettes
	 */
	monClic: function() {

		// Je récupère ma vignette
		var index = $(this).index()

		// Je récupère l'image qui correspond
		var image = $("#slider img").eq(index)

		// Je cache l'image actuelle
		$("#slider .active").fadeOut().removeClass("active")

		// J'affiche la nouvelle
		image.fadeIn().addClass("active")
	}

}


/************************
 * 	  Objet de menu 	*
 ************************/

nav={

	create: function() {
		console.info("nav.create")

		// on créer une div
		nav.container = $("<div>",{
			id: "portrait",
			css: {
				display: "none",
				width: "17.1%",
				height: "100%",
				background: "url(img/whitey.png)",
				color: "#462a15",
				position:"absolute"
			}
		})

		// on ajoute un titre au conteneur
		var titre = $("<h3>")
		titre.text("Menu")
		nav.container.append(titre)

		// on crée un bouton de repli du menu
		nav.close =$("<div>",{
			id:"close",
			css:{
				background:"url('img/close.png')",
				width: "30px",
				height: "30px",
				position:"absolute",
				bottom: 10,
				right: 10,
				cursor: "pointer"
			}
		})

		// on pose un écouteur sur le bouton close
		nav.close.on('click',nav.clear)

		// on ajoute le container dans le body
		$("body").append(nav.container.append(nav.close))


		// en ajax on récupère les données du menu de header.php
		$.ajax({
			url: 'nav.php',
			success:  nav.display
		})

	},

	display :function(html){
		console.info("nav.display")

		// on ajoute le menu au container
		nav.container.append(html)

		// on efface le bouton et on affiche le menu
		$("#nav-icone").fadeOut(function(){nav.container.toggle()})
	},

	clear :function () {
		console.info("nav.display")

		// on efface le menu et on affiche le bouton menu
		nav.container.toggle(function(){$("#nav-icone").fadeIn()})

		// on efface le menu
		nav.container.remove()
	}

}








/************************
 * 	 Objet principal 	*
 ************************/

app = {
	/*
	 * Fonction appelée au chargement du DOM
	 */
	init: function() {
		console.info("app.init")

		// Lance le carousel
		carousel.init()

		//on pose un écouteur sur le bouton de menu
		$("#nav-icone").on("click", nav.create)
	}

}



/*
 * Chargement du DOM
 */
$(function(){
	app.init()
})