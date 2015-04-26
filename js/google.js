GoogleApi ={

	initialize : function(){
		// intégration google maps avec Google Maps Javascript API v3
		console.info('app.initialize')

		//Initialisation de la carte sur l'église d'Agnetz
		var latLng = new google.maps.LatLng(49.3825128, 2.3847506) // Correspond au coordonnées d'Agnetz
		var myOptions = {
		    zoom      : 14,
		    center    : latLng,
		    mapTypeId : google.maps.MapTypeId.ROADMAP, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
		    maxZoom   : 20
		}

	  	var map = new google.maps.Map(document.getElementById('map'), myOptions)

	  	// création d'un marker
	  	var marker = new google.maps.Marker({
		    position : latLng,
		    map      : map,
		    title    : "Eglise Saint léger d'Agnetz"
		    //icon: "ChurchIcone.png"
		})

	  	// création d'une info-bulle lié au marker définit précédemment
		var contentMarker = 'Eglise Saint léger d\'Agnetz <br /> Cérémonie à 15h30'

		var infoWindow = new google.maps.InfoWindow({
		    content  : contentMarker,
		    position : latLng
		})

		// on ajoute l'écouteur pour l'info bulle
		google.maps.event.addListener(marker, 'click', function() {
    		infoWindow.open(map,marker)
		})

		// création un 2ème marker
		var latLngBis = new google.maps.LatLng(49.381946, 2.387540)
	  	var markerBis = new google.maps.Marker({
		    position : latLngBis,
		    map      : map,
		    title    : "Agnetz Cottage"
		    //icon: "ChurchIcone.png"
		})

	  	// création d'une info-bulle lié au marker définit précédemment
		var contentMarkerBis = 'Agnetz Cottage <br /> Cocktail à 17h00'

		var infoWindow = new google.maps.InfoWindow({
		    content  : contentMarkerBis,
		    position : latLngBis
		})

		// on ajoute l'écouteur pour l'info bulle
		google.maps.event.addListener(markerBis, 'click', function() {
    		infoWindow.open(map,markerBis)
		})
	}
}

/*
 * Chargement du DOM
 */
$(document).on("DOMContentLoaded", function(){
    GoogleApi.initialize()
})