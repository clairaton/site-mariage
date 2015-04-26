app ={
	/*
     * Fonction appelée au chargement du DOM
     */
	init:function(){
		console.info("app.init")

		// On pose un écouteur sur le bouton connect
		$("#connect").on("submit", app.connection)

		// On lance l'animation de départ
		app.animation()

		// On lance le compteur
		app.countDown()

		// On lance l'écouteur du hover sur la classe pannel
		$('.pannel').hover(app.panelEnter,app.panelLeave)

		// On lance l'écouteur du clic sur la classe pannel
		$('.pannel').on('click',app.panelSelect)

	},

/*
* Name: connection
* Definition: Vérifie si le mot de passe est correct
* Param : e l'évènement au clic
* Result : si le mot de passe est incorrect on ajoute un message d'erreur
*
*/

	connection:function(e){
		// vérification de la connection en js
		console.info("app.connection")

		// On récupère ce qui a été saisi comme mot de passe
		var psw = $("#connect input[type=text]").val()

		// On définit un tableau avec les différents mots de passe
		var ident = ["cécile-samy","12/09/2015"]

		// On vérifie le mot de passe

			// Si le mot de passe est le premier, le msg affiché sera celui du cocktail
		if(psw == ident[0] || psw == ident[1]){
		}
		else{
			// Message d'erreur
			var msg = "ce n'est pas le bon mot de passe, réessayez"
			// On remet le formulaire à zéro
			$("#connect input[type=text]").val("").focus()
			// On affiche le message d'erreur
			$("<p>")
				.appendTo($("#connect"))
				.text(msg)
		}
	},

/*
* Name: countDown
* Definition: Fonction servant à calculer le nombre de jour  jusqu'à une date donnée
* Result :ajoute un div #days avec le chiffre calculé
*
*/

	countDown: function(){
		console.info(app.CountDown)
		// On calcule le nombre de jour entre la date d'aujourd'hui et celle du Mariage
		var J = new Date()
		var M = new Date('2015-09-12')
		var tmp = M - J

		var diff ={}

		tmp = Math.floor(tmp/1000)             // Nombre de secondes entre les 2 dates
	    diff.sec = tmp % 60                    // Extraction du nombre de secondes

	    tmp = Math.floor((tmp-diff.sec)/60)    // Nombre de minutes (partie entière)
	    diff.min = tmp % 60                    // Extraction du nombre de minutes

	    tmp = Math.floor((tmp-diff.min)/60)    // Nombre d'heures (entières)
	    diff.hour = tmp % 24                   // Extraction du nombre d'heures

	    tmp = Math.floor((tmp-diff.hour)/24)   // Nombre de jours restants
    	diff.day = tmp

    	tmp = 'J- '+tmp

    	// on lance l'animation
    	$("#day").text(tmp)
	},

/*
* Name: animation
* Definition: Affiche le teaser du site au chargement de la page avec une aninmation de rebond
* Result : place le teaser à sa place finale d'affichage
*
*/

	animation:function(){

		// je récupère le teaser
		var teaser = $(".teaser")

		// je lui affecte sa postion avec une animation
        teaser.animate({
            marginTop: "60px"
        },
        {
            duration: 1500,
            complete: function() {
                $(this).fadeIn()
            },
            easing: "easeOutBounce"
        })
	},

/*
* Name: panelEnter
* Definition: Affiche un rideau de text avec info au survol avec une animation de slide
* Result : affiche un p
*
*/

	panelEnter : function(){
		console.info('app.panelEnter')
		// on récupère l'id de l'élément
		var id = '#'+$(this).context.id
		// on défini le selecteur sur lequel je veux faire une animation
		var selector = id+' p'
		// on lui applique le format que je veux
		$(selector).slideDown()
	},

/*
* Name: panelLeave
* Definition: cache le rideau de text avec info à la sortie du survol
* Result : cache le p
*
*/

	panelLeave : function(){
		console.info('app.panelLeave')
		// je récupère l'id de l'élément
		var id = '#'+$(this).context.id
		// je défini le selecteur sur lequel je veux faire une animation
		var selector = id+' p'
		// je le fait disparaître
		$(selector).slideUp("fast")
	}

}


/*
 * Chargement du DOM
 */
$(document).on("DOMContentLoaded", function(){
    app.init()
})

jQuery.extend( jQuery.easing,
{
    easeOutBounce: function (x, t, b, c, d) {
        if ((t/=d) < (1/2.75)) {
            return c*(7.5625*t*t) + b;
        } else if (t < (2/2.75)) {
            return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
        } else if (t < (2.5/2.75)) {
            return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
        } else {
            return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
        }
    }
});