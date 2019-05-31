/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var map;

var table = document.getElementById('w0');
var ltd = parseFloat(table.rows[5].cells[1].innerHTML);
var lng = parseFloat(table.rows[6].cells[1].innerHTML);
console.log(ltd);
console.log(lng);



function initMap() {
    
    var marker;
    
    map = new google.maps.Map(document.getElementById('placeView'), {
        center: {lat: ltd, lng: lng},
        zoom: 18
    });

    
        var latLng = {lat: ltd, lng: lng};
        marker = new google.maps.Marker({
          position: latLng,
          map: map,
//          title: 'Hello World!'
        });
        console.log(latLng);
    

}


