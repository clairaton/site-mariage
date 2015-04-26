 /************************
 * 	  Objet de menu 	*
 ************************/

nav={

	create: function() {
		console.info("nav.create")

		// on créer une div
		nav.container = $("<div>",{
			id: "landscape",
			css: {
				display: "none",
				width: "70%",
				height: "100px",
				background: "url(img/whitey.png)",
				color: "#462a15",
				position: "absolute",
				top: 0,
				left: "15%"
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
		$("#nav-iconebis").fadeOut(function(){nav.container.toggle()})
	},

	clear :function () {
		console.info("nav.display")

		// on efface le menu et on affiche le bouton menu
		nav.container.toggle(function(){$("#nav-iconebis").fadeIn()})

		// on efface le menu
		nav.container.remove()
	}

}

picture ={
	/*
	 * Fonction appelée au clic sur une image
	 */

	 hoverPic :function(e){
		console.info("picture.hoverPic")
		console.log(e)

		// on crée une div d'information
		$('#info').css({
			display: 'block',
			top: e.pageY-123,
			left: e.pageX-70
		})
		
		// on place un écouteur sur le déplacement de la souris
		$('#gallery img').on('mousemove',picture.hoverPic)

	},

	moveInfo : function(e){
		console.info("picture.moveInfo")

		// on suit la souris
		$('#info').css({
			top: e.pageY-123,
			left: e.pageX-70
		})
	},	

	leavePic : function(){
		console.info("picture.leavePic")
		// on efface la div d'information
		$('#info').css({
			display:'none'
		})

		// on place un écouteur sur le déplacement de la souris
		$('#gallery img').off('mousemove',picture.hoverPic)
	},


	 displayPic :function(){
		console.info("picture.displayPic")

	 	// on récupère le de la photo
	 	var html = this

	 	// on crée le film opaque
	 	$('<div>',{
	 		id:"big-pic",
	 		css:{
	 			backgroundColor: "rgba(0,0,0,0.9)",
			    backgroundRepeat: "no-repeat",
			    backgroundAttachment: "absolute",
			    zIndex:9,
			    top:0,
			    left:0,
			    width: "100%",
			    height:"100%"
	 		}
	 	}).appendTo($('.container'))

	 	// on insère la photo dans une balise image

	 	// on créer un bouton télécharger sur lequel on place un écouteur
	 	$('#uploader').on('click', picture.uploadPic)

	 	// on créé un bouton fermer sur lequel on place un écouteur
	 	$('#closer').on('click', picture.closePic)

	 	// on intègre tout cela dans notre body
	 },

	/*
	 * Fonction appelée au clic sur le bouton téléchargement
	 */
	 uploadPic :function(){
		console.log("picture.uploadPic")
	 	//
	 },

	/*
	 * Fonction appelée au clic sur le bouton téléchargement
	 */
	 closePic :function(){
	 	console.log("picture.closePic")
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

		//on pose un écouteur sur le bouton de menu
		$("#nav-iconebis").on("click", nav.create)

	 	// on place un écouteur sur les images
	 	$('#gallery img').on('click', picture.displayPic)

	 	// on place un écouteur au survol de l'image
		$('#gallery img').hover(picture.hoverPic, picture.leavePic)

	}

}



/*
 * Chargement du DOM
 */
$(function(){
	app.init()
})