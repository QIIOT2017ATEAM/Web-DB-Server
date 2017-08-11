function initMap()
{

  var air2 =
  (function ()
  {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        // your script that outputs json data …
        'url': "slim-api/air-as-json",
        'dataType': "json",
        'success': function (data)
        {
          json = data;
        }
      }
    );
    return json;
  }
  )();
 // aqiboxes();
var map = new google.maps.Map(document.getElementById('map'),
{
  zoom: 17,
  center: {lat: 32.882407, lng: -117.234817},
  mapTypeId: google.maps.MapTypeId.ROAD
}
);

for (var data in air2)
{
var marker = new google.maps.Marker(
{
  position: air2[data].center,
  map: map,
  icon:'A.png'
}
);

if(air2[data].co <= 50)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#00ff08',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#98f29b',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
else if(air2[data].co <= 100)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#F4F122',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#F7F5A0',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
else if(air2[data].co <= 150)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#ff9000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#e8c276',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
else if(air2[data].co <= 200)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#dd7575',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
else if(ai2[data].co <= 300)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#a01088',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#ce90c4',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
else if(air2[data].co <= 500)
{
  var cityCircle = new google.maps.Circle
  (
    {
      strokeColor: '#9b0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#a53131',
      fillOpacity: 0.35,
      map: map,
      center: air2[data].center,
      radius: 25
    }
  );
}
//  clearTimeout(initMap);
}
setTimeout(initMap,8000);

}
