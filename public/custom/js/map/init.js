  var infowindow;
 function initialize_search(){
      goo = google.maps,
          map_in=new goo.Map(document.getElementById('map_in'), {
              zoom: 12,
              center: new goo.LatLng(44.42684, 26.1025)
          });
      drawman = new goo.drawing.DrawingManager({
          map: map_in,
      }),
      shapes = [],
      selected_shape = null,
      hideDrawingManager=function(){
              drawman.setMap(null);
      };
      clearShapes = function() {
          for (var i = 0; i < shapes.length; ++i) {
              shapes[i].setMap(null);
          }
          shapes = [];
      };
      var map = new google.maps.Map(document.getElementById('map_in'),
          map_in);
      goo.event.addDomListener(map, 'tilesloaded', function() {
         hideDrawingManager();
      });
  };
   function initialize() {
             goo = google.maps,
             map_in=new goo.Map(document.getElementById('map_in'), {
                     zoom: 12,
                  center: new goo.LatLng(44.42684, 26.1025)
              });
             shapes = [],
             selected_shape = null,
             drawman = new goo.drawing.DrawingManager({
                 map: map_in,
                 polygonOptions: {editable:true,fillColor: _config["polygonColor"],strokeColor: _config["polygonColor"],strokeWeight:2}
             }),
             byId = function(s) {
                 return document.getElementById(s);
             },
             clearSelection = function() {
                 if (selected_shape) {
                     selected_shape.set((selected_shape.type === google.maps.drawing.OverlayType.MARKER) ? 'draggable' : 'editable', false);
                     selected_shape = null;
                 }
             },
             setSelection = function(shape) {
                 clearSelection();
                 selected_shape = shape;
                 selected_shape.set((selected_shape.type === google.maps.drawing.OverlayType.MARKER) ? 'draggable' : 'editable', true);
             },
             clearShapes = function() {
                 for (var i = 0; i < shapes.length; ++i) {
                     shapes[i].setMap(null);
                 }
                 shapes = [];
                 disableElement('#btnPolygon',false);
                 drawman.drawingControl=true;
             };
             hideDrawingManager=function(){
                 drawman.setMap(null);
             };
             disableDrawingControl=function(){
                 drawman.drawingControl=false;
                 disableElement('#btnPolygon',true);
                 $('#btnHand').click();
             };
        var map = new google.maps.Map(document.getElementById('map_in'),
           map_in);
         goo.event.addListenerOnce(map, 'tilesloaded', function() {
                 customizeGoogleMapsButtons();
         });
         goo.event.addDomListener(drawman, 'overlaycomplete', function(e) {
             var shape = e.overlay;
             shape.type = e.type;
             goo.event.addListener(shape, 'click', function() {
                 setSelection(this);
             });
             setSelection(shape);
             shapes.push(shape);
         });
         goo.event.addListener(map_in, 'click', clearSelection);
         goo.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
         goo.event.addDomListener(drawman,'polygoncomplete',disableDrawingControl);
     }
     var IO = {
         //returns array with storable google.maps.Overlay-definitions
         IN: function(arr, //array with google.maps.Overlays
             encoded //boolean indicating whether pathes should be stored encoded
         ) {
             var shapes = [],
                 goo = google.maps,
                 shape, tmp;
             for (var i = 0; i < arr.length; i++) {
                 shape = arr[i];
                 tmp = {
                     type: this.t_(shape.type),
                     id: shape.id || null
                 };
                 switch (tmp.type) {
                     case 'POLYGON':
                         tmp.geometry = this.m_(shape.getPaths(), encoded);
                         break;
                 }
                 shapes.push(tmp);
             }
             return shapes;
         },
         //returns array with google.maps.Overlays
         OUT: function(arr, //array containg the stored shape-definitions
             map,//map where to draw the shape
             shapeColor
         ) {
             shapes=[];
             var goo = google.maps,
                 map = map || null,
                 shape, tmp;
             for (var i = 0; i < arr.length; i++) {
                 shape = arr[i];
                 switch (shape.type) {
                     case 'POLYGON':
                         tmp = new goo.Polygon({
                             paths: this.mm_(shape.geometry),
                             strokeColor: shapeColor,
                             strokeOpacity: 1.0,
                             fillColor:shapeColor,
                             fillOpacity: 0.35,
                             position:this.mm_.apply(this,shape.geometry),
                         });

                         tmp.getPosition = function() {
                             var lastPath = null,
                                 lastCenter = null;
                             var path = this.getPath();
                             if (lastPath == path) {
                                 return lastCenter;
                             }
                             lastPath = path;
                             var bounds = new google.maps.LatLngBounds();
                             path.forEach(function(latlng, i) {
                                 bounds.extend(latlng);
                             });

                             lastCenter = bounds.getCenter();
                             return lastCenter;
                         };

                         if(_config["page"]=="search") {
                             google.maps.event.addListener(tmp, 'click', function (event) {
                                 infowindow=handleInfoWindow(infowindow,map,event);
                                 map.center=tmp.getPosition();
                                 map.zoom=12;
                             });
                             google.maps.event.addListener(map, 'click', function (event) {
                                 infowindow.close();
                             });
                         }
                         else if(_config["page"]=="terrain"){
                             google.maps.event.addListener(tmp, 'click', function (event) {
                                 $('ul.nav-tabs a[href="#proiect"]').tab('show');
                                 tmp.setEditable(true);
                             });
                         }
                         break;
                 }
                 tmp.setValues({
                     map: map,
                     id: shape.id
                 })
                 shapes.push(tmp);
             }
             var clusterer = new MarkerClusterer(map, shapes);
             return shapes;
         },
         l_: function(path, e) {
             path = (path.getArray) ? path.getArray() : path;
             if (e) {
                 return google.maps.geometry.encoding.encodePath(path);
             } else {
                 var r = [];
                 for (var i = 0; i < path.length; ++i) {
                     r.push(this.p_(path[i]));
                 }
                 return r;
             }
         },
         ll_: function(path) {
             if (typeof path === 'string') {
                 return google.maps.geometry.encoding.decodePath(path);
             } else {
                 var r = [];
                 for (var i = 0; i < path.length; ++i) {
                     r.push(this.pp_.apply(this, path[i]));
                 }
                 return r;
             }
         },
         m_: function(paths, e) {
             var r = [];
             paths = (paths.getArray) ? paths.getArray() : paths;
             for (var i = 0; i < paths.length; ++i) {
                 r.push(this.l_(paths[i], e));
             }
             return r;
         },
         mm_: function(paths) {
             var r = [];
             for (var i = 0; i < paths.length; ++i) {
                 r.push(this.ll_.call(this, paths[i]));
             }
             return r;
         },
         p_: function(latLng) {
             return ([latLng.lat(), latLng.lng()]);
         },
         pp_: function(lat, lng) {
             return new google.maps.LatLng(lat, lng);
         },
         b_: function(bounds) {
             return ([this.p_(bounds.getSouthWest()),
                 this.p_(bounds.getNorthEast())
             ]);
         },
         bb_: function(sw, ne) {
             return new google.maps.LatLngBounds(this.pp_.apply(this, sw), this.pp_.apply(this, ne));
         },
         t_: function(s) {
             var t = ['CIRCLE', 'MARKER', 'RECTANGLE', 'POLYLINE', 'POLYGON'];
             for (var i = 0; i < t.length; ++i) {
                 if (s === google.maps.drawing.OverlayType[t[i]]) {
                     return t[i];
                 }
             }
         }
     };
  function handleInfoWindow(infowindow,map,event,shape){
      if(isInfoWindowOpen(infowindow)){
          infowindow.setPosition(event.latLng)
      }
      else {
          infowindow = new google.maps.InfoWindow({
              content: setupPopUp().html()
          });
          getInfo();
          infowindow.open(map);
          infowindow.setPosition(event.latLng)
      }
      return infowindow;
  }

  function setupPopUp(){
      var popupContent=$('#terrainPopUp').clone();
      popupContent.find('#contact').attr("id","contact2");
      popupContent.find('#poze').attr("id","poze2");
      popupContent.find('#contactLink').attr("href","#contact2");
      popupContent.find('#pozeLink').attr("href","#poze2");
      popupContent.attr("style","display:block");
      return popupContent;
  }

  function isInfoWindowOpen(infoWindow){
      if(infoWindow!=null) {
          var map = infoWindow.getMap();
          return (map !== null && typeof map !== "undefined");
      }
      else return false;
  }

  if(_config["page"]=="terrain") {
         google.maps.event.addDomListener(window, 'load', initialize);
     }
  else if(_config["page"]=="search"){
         google.maps.event.addDomListener(window, 'load', initialize_search);
  }