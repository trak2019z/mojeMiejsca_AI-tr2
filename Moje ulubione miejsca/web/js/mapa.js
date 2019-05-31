/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.9, lng: 22.3},
        zoom: 8
    });
//
//    map.addListener("click", function (event) {
//        var latitude = event.latLng.lat();
//        var longitude = event.latLng.lng();
//        console.log(latitude + ', ' + longitude);
//
//        radius = new google.maps.Circle({map: map,
//            radius: 100,
//            center: event.latLng,
//            fillColor: '#777',
//            fillOpacity: 0.1,
//            strokeColor: '#AA0000',
//            strokeOpacity: 0.8,
//            strokeWeight: 2,
//            draggable: true, // Dragable
//            editable: true      // Resizable
//        });
//
//        // Center of map
//        map.panTo(new google.maps.LatLng(latitude, longitude));
////        location.href='http://91.188.125.149/index.php?r=places%2Fcreate';
//    }); //end addListener

}


