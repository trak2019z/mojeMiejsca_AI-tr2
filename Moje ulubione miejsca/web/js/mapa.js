/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var script = document.createElement('script');
script.src = 'http://77.55.220.183/index.php?r=places%2Fjson';
document.getElementsByTagName('head')[0].appendChild(script);

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.9, lng: 22.3},
        zoom: 8
    });




    window.eqfeed_callback = function (results) {

        

        for (var i = 0; i < results.features.length; i++) {
            var coords = results.features[i].geometry.coordinates;
            var stars;
            switch (results.features[i].properties.grade) {
                default:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
                case 2:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
                case 3:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
                case 4:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
                case 5:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
                case 6:
                    stars="<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>"
                    +"<img src='http://77.55.220.183/js/baseline-star_border-24px_yellow_1.png'/>";
                    break;
            }
            if(results.features[i].properties.link==="") {
               var contentString = "<h2>"+results.features[i].properties.name+'</h2>'
                +"<p>"+results.features[i].properties.text+"</p>"
                +"<p>Ocena: "+stars+"</p>"; 
            } else {
                var contentString = "<h2>"+results.features[i].properties.name+'</h2>'
                +"<p>"+results.features[i].properties.text+"</p>"
                +"<p>Ocena: "+stars+"</p>"
                +"<p>Dodatkowe informacje: <a href='"+results.features[i].properties.link+"'>Link do strony</a></p>";
            }
            
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            var latLng = new google.maps.LatLng(coords[1], coords[0]);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            google.maps.event.addListener(marker, 'click', (function (marker, contentString, infowindow) {
                return function () {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                    windows.push(infowindow)
                    google.maps.event.addListener(map, 'click', function () {
                        infowindow.close();
                    });
                };
            })(marker, contentString, infowindow));

        }
    };


}


