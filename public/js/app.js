 var map;
 var markers = [];
 var bounds;
 var locations = [{
         info: '<strong>Chipotle on Broadway</strong>',
         lat: 41.976816,
         lng: -87.659916,
         zIndex: 1
     }
 ];
 containerMap = document.getElementById("map");

 function initMap() {

     var ini = { lat: locations[0].lat, lng: locations[0].lng };
     map = new google.maps.Map(containerMap, {
         zoom: 13,
         center: ini,
         mapTypeId: google.maps.MapTypeId.ROADMAP
     });
     addMultipleMarker(locations);
 }

 //dado un array de coordenadas, crea los marcadores
 function addMultipleMarker(locs) {
     for (i = 0; i < locs.length; i++) {
         addMarker(locs[i]);
     }
 }

 // Agrega un marcador al mapa lo agrega al array general
 function addMarker(location) {
     var marker = new google.maps.Marker({
         position: { lat: location.lat, lng: location.lng },
         map: map,
         title: location.info,
         zIndex: location.zIndex
     });
     //definimos el objeto que actuara como ventana
     var infoWindow = new google.maps.InfoWindow({
         content: '<strong>' + location.info + '</strong>'
     });

     //agregamos objeto al evento click del marcador
     marker.addListener('click', function() {
         infoWindow.open(map, marker);
     });
     markers.push(marker);
 }

 // Sets the map on all markers in the array.
 function setMapOnAll(map) {
     for (var i = 0; i < markers.length; i++) {
         markers[i].setMap(map);
     }
 }

 // Removes the markers from the map, but keeps them in the array.
 function clearMarkers() {
     setMapOnAll(null);
 }

 // Sets the map on all markers in the array.
 function setMapOnAll(map) {
     for (var i = 0; i < markers.length; i++) {
         markers[i].setMap(map);
     }
 }

 // Shows any markers currently in the array.
 function showMarkers() {
     setMapOnAll(map);
 }

 // Deletes all markers in the array by removing references to them.
 function deleteMarkers() {
     clearMarkers();
     markers = [];
 }

 //formatea los datos traidos del servidor
 function formatJson(json) {
     resp = [];
     for (i = 0; i < json.length; i++) {
         data = {
             info: (json[i].info) ? json[i].info : json[i].time,
             lat: json[i].latitude,
             lng: json[i].longitude,
             zIndex: i + 1
         };
         resp.push(data);
     }
     return resp;
 }

if (document.readyState === "complete") {
    initMap();
} else {
    google.maps.event.addDomListener(window, 'load', initMap);
}
