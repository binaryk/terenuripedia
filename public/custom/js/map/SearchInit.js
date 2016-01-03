if(_config["page"]=="search"){
  google.maps.event.addDomListener(window, 'load', initialize_search);
}

function initialize_search(){
  goo = google.maps;

  map_in=new goo.Map(document.getElementById('map_in'), {
    zoom: 11,
    center: new goo.LatLng(44.42684, 26.1025),
    disableDefaultUI: false,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
      position: google.maps.ControlPosition.TOP_CENTER
    },
    zoomControl: true,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_CENTER,
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
    },
    scaleControl: true,
    streetViewControl: false,
    streetViewControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER
    }
  });

  drawman = new goo.drawing.DrawingManager({
    map: map_in,
    drawingControl: false
  }),
      shapes = [],
      selected_shape = null,
      clearShapes = function() {
        for (var i = 0; i < shapes.length; ++i) {
          shapes[i].setMap(null);
        }
        for (var i = 0; i < buyer_shapes.length; ++i) {
          buyer_shapes[i].setMap(null);
        }
        shapes = [];
        buyer_shapes = [];
      };
  map = new google.maps.Map(document.getElementById('map_in'),map_in);
};