/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var map;

if (!document.getElementsByName('Places[latitude]')[0].value) {
    var ltd = 49.9;
    var lng = 22.3;
    zm=8;
    console.log(ltd);
} else {
    var ltd =parseFloat(document.getElementsByName('Places[latitude]')[0].value);
    console.log(ltd);
    
    if (!document.getElementsByName('Places[longitude]')[0].value) {
        var ltd = 49.9;
        var lng = 22.3;
        zm=8;            
        console.log(lng);
    } else {
        var lng = parseFloat(document.getElementsByName('Places[longitude]')[0].value);
        zm=18;
        
        var MAPDEFINED=1;       
        
        console.log(lng);
    }
    
    
}



function initMap() {
    
    var marker;
    
    map = new google.maps.Map(document.getElementById('createMap'), {
        center: {lat: ltd, lng: lng},
        zoom: zm
    });

    if(MAPDEFINED) {
        var latLng = {lat: ltd, lng: lng};
        marker = new google.maps.Marker({
          position: latLng,
          map: map,
          title: 'Hello World!'
        });
        console.log(latLng);
    }

    map.addListener("click", function (event) {
        var latitude = event.latLng.lat();
        var longitude = event.latLng.lng();
        console.log(latitude + ', ' + longitude);
        if(marker) {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map,
          title: 'Hello World!'
        });

        
        
        
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
        document.getElementsByName('Places[latitude]')[0].value=latitude;
        document.getElementsByName('Places[longitude]')[0].value=longitude;
        // Center of map
        map.panTo(new google.maps.LatLng(latitude, longitude));
//        location.href='http://91.188.125.149/index.php?r=places%2Fcreate';
    }); //end addListener

}


