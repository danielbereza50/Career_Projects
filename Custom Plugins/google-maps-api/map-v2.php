<?php

add_shortcode('map', 'google_map');
function google_map(){
	ob_start();
	?>
	
<!-- https://developers.google.com/maps/documentation/javascript/examples/maptype-styled-simple#all -->

 <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 40%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
      #map {
    padding-top: 70%;
		  margin-top: 5%;
}
#content{
    text-align: left;
}
		.gm-style-mtc{display:inline-block !important}
		.gm-svpc{display:inline-block !important}
		
		@media screen and (max-width:900px){
			.gmnoprint {
    display: none !important;
}
		}
		
    </style>
    <script>
      function initMap() {
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        const styledMapType = new google.maps.StyledMapType(
          [
              // here
            { elementType: "geometry", stylers: [{ color: "#E7FFF4" }] },
            {
              elementType: "labels.text.fill",
              stylers: [{ color: "#523735" }],
            },
            {
              elementType: "labels.text.stroke",
              stylers: [{ color: "#f5f1e6" }],
            },
            {
              featureType: "administrative",
              elementType: "geometry.stroke",
              stylers: [{ color: "#c9b2a6" }],
            },
            {
              featureType: "administrative.land_parcel",
              elementType: "geometry.stroke",
              stylers: [{ color: "#dcd2be" }],
            },
            {
              featureType: "administrative.land_parcel",
              elementType: "labels.text.fill",
              stylers: [{ color: "#ae9e90" }],
            },
            {
               // here
              featureType: "landscape.natural",
              elementType: "geometry",
              stylers: [{ color: "#E7FFF4" }],
            },
            {
                // here
              featureType: "poi",
              elementType: "geometry",
              stylers: [{ color: "#E7FFF4" }],
            },
            {
              featureType: "poi",
              elementType: "labels.text.fill",
              stylers: [{ color: "#93817c" }],
            },
            {
                // here
              featureType: "poi.park",
              elementType: "geometry.fill",
              stylers: [{ color: "#E7FFF4" }],
            },
            {
              featureType: "poi.park",
              elementType: "labels.text.fill",
              stylers: [{ color: "#447530" }],
            },
            {
              featureType: "road",
              elementType: "geometry",
              stylers: [{ color: "#f5f1e6" }],
            },
            {
              featureType: "road.arterial",
              elementType: "geometry",
              stylers: [{ color: "#fdfcf8" }],
            },
            {
              featureType: "road.highway",
              elementType: "geometry",
              stylers: [{ color: "#f8c967" }],
            },
            {
              featureType: "road.highway",
              elementType: "geometry.stroke",
              stylers: [{ color: "#e9bc62" }],
            },
            {
              // here
              featureType: "road.highway.controlled_access",
              elementType: "geometry",
              stylers: [{ color: "#E6E6E6" }],
            },
            {
				// here
              featureType: "road.highway.controlled_access",
              elementType: "geometry.stroke",
              stylers: [{ color: "#E6E6E6" }],
            },
            {
              featureType: "road.local",
              elementType: "labels.text.fill",
              stylers: [{ color: "#806b63" }],
            },
            {
              featureType: "transit.line",
              elementType: "geometry",
              stylers: [{ color: "#dfd2ae" }],
            },
            {
              featureType: "transit.line",
              elementType: "labels.text.fill",
              stylers: [{ color: "#8f7d77" }],
            },
            {
              featureType: "transit.line",
              elementType: "labels.text.stroke",
              stylers: [{ color: "#ebe3cd" }],
            },
            {
              featureType: "transit.station",
              elementType: "geometry",
              stylers: [{ color: "#dfd2ae" }],
            },
            {
              featureType: "water",
              elementType: "geometry.fill",
              stylers: [{ color: "#b9d3c2" }],
            },
            {
              featureType: "water",
              elementType: "labels.text.fill",
              stylers: [{ color: "#92998d" }],
            },
          ],
          { name: "Styled Map" }
        );
        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        const map = new google.maps.Map(document.getElementById("map"), {
          center: {lat:x, lng: y},
          zoom: 15,
          mapTypeControlOptions: {
            mapTypeIds: [
              "roadmap",
              "satellite",
              "hybrid",
              "terrain",
              "styled_map",
            ],
          },
        });
        
        
    var myLatLng = {lat:x, lng: y};
  	
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
    });
    
  var contentString = '<div id="content">' +
    '<div id="siteNotice">' +
   '<div>Business</div>' +
   '<div><a href = "" target = "_blank">Directions</a></div>' +
    '</div>' +
    '</div>';
    
    var infowindow = new google.maps.InfoWindow({
    content: contentString
  });
    
  //google.maps.event.addListener(marker, 'click', function() {
    //infowindow.open(map, marker);
 // });  
		  infowindow.open(map, marker);
  
        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set("styled_map", styledMapType);
        map.setMapTypeId("styled_map");
      }
    </script>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key={KEY_VALUE}&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  <?php
	return ob_get_clean();
}