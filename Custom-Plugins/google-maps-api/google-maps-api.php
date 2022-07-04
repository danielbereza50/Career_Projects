<?php
// class name
class google_map
{
    // class properties

    // class methods
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('map', array(
            $this,
            'google_map'
        ));
    }

    public static function google_map()
    {
        ob_start();
        
        ?>

<style>
#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
    
<script>
        
jQuery(function($) {
// Asynchronously Load the map API 
var script = document.createElement('script');
//script.src = "//maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
script.src = "https://maps.googleapis.com/maps/api/js?key={KEY_VALUE}&callback=initialize"
document.body.appendChild(script);
});
function initialize() {
var map;
var bounds = new google.maps.LatLngBounds();
var mapOptions = {
mapTypeId: 'roadmap',
 scrollwheel: true,
    navigationControl: true,
    mapTypeControl: false,
    scaleControl: true,
    zoomControl: false,
    draggable: true,

};
// Display a map on the page
map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
map.setTilt(45);
// Multiple Markers
var markers = [
['', x,y],
['', x,y]
]
;
// Info Window Content
var infoWindowContent = [
[
'<div class="info_content">'+
'<a href = "" target = "_blank">' + 
'<b>Click anywhere in this model for directions<b>' +
'<h5></h5>' +
'<p></p>' + 
'</a>'+ 
'</div>'
],

[
'<div class="info_content">' +
'<a href = "" target = "_blank">' + 
'<b>Click anywhere in this model for directions<b>' +
'<h5></h5>' +
'<p></p>' +
'</a>' +
'</div>'

],

];
// Display multiple markers on a map
var infoWindow = new google.maps.InfoWindow(), marker, i;
// Loop through our array of markers & place each one on the map  
for( i = 0; i < markers.length; i++ ) {
var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
bounds.extend(position);
marker = new google.maps.Marker({
position: position,
map: map,
title: markers[i][0]
});
// Allow each marker to have an info window    
google.maps.event.addListener(marker, 'click', (function(marker, i) {
return function() {
infoWindow.setContent(infoWindowContent[i][0]);
infoWindow.open(map, marker);
}
})(marker, i));
// Automatically center the map fitting all markers on the screen
map.fitBounds(bounds);
}
// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
this.setZoom(8);
google.maps.event.removeListener(boundsListener);
});
}
</script>

<div id="map_wrapper">
<div id="map_canvas" class="mapping"></div>
</div>

<?php
        return ob_get_clean();
    }

}
$obj2 = new google_map;

