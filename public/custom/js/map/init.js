function initMap() {
}
if(_config["page"]=="terrain") {
    google.maps.event.addDomListener(window, 'load', initMap);
}

function initialize() {
    console.log('initialize');

    goo = google.maps;
    var mapOptions = {
        zoom: 12,
        center: {lat: 44.42684, lng: 26.1025},
        disableDefaultUI: true,

    }
    map_in=new goo.Map(document.getElementById('map_in'), {
        zoom: 12,
        center: new goo.LatLng(44.42684, 26.1025),
        disableDefaultUI: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER
        },
        scaleControl: true,
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER
        }
    });
    shapes = [],
        buyer_shapes = [],
        selected_shape = null,
        drawman = new goo.drawing.DrawingManager({
            map: map_in,
            polygonOptions: {editable:true,fillColor: _config["polygonColor"],strokeColor: _config["polygonColor"],strokeWeight:2},
            drawingControl: false
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
    /*    clearShapes = function() {
            console.log(2);

            for (var i = 0; i < shapes.length; ++i) {
                shapes[i].setMap(null);
            }
            shapes = [];
            disableElement('#btnPolygon',false);
        },*/
        hideDrawingManager=function(){
            drawman.setMap(null);
        };
    disableDrawingControl=function(){
        drawman.drawingControl=false;
        disableElement('#btnPolygon',true);
        $('#btnHand').click();
    };
    var map = new google.maps.Map(document.getElementById('map_in'),map_in);
    goo.event.addDomListener(drawman, 'overlaycomplete', function(e) {
        var shape = e.overlay;
        shape.type = e.type;
        goo.event.addListener(shape, 'click', function() {
            setSelection(this);
        });
        setSelection(shape);
        shapes.push(shape);
    });

    /* google.maps.event.addListener(drawingManager, "overlaycomplete", function(event){
     vanPolygon = true;
     overlayClickListener(event.overlay);
     $('#polydata').val(event.overlay.getPath().getArray());
     poly = event.overlay;
     genPolygonID();
     setPolyCoords2Array(poly);
     });*/

    goo.event.addListener(map_in, 'click', clearSelection);
    goo.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
    goo.event.addDomListener(drawman,'polygoncomplete',disableDrawingControl);
}


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
