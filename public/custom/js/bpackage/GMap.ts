declare var $;
declare var bootbox;
declare var drawman;
declare var google;
declare var _config;
var shapes : any;
var _that  : any;

interface IMapParams{
    center: Object;
    zoom  : number;
}

function CenterControl(controlDiv, map) {

    // Set CSS for the control border.
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#fff';
    controlUI.style.border = '2px solid #ccc';
    controlUI.style.borderRadius = '0';
    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    controlUI.style.cursor = 'pointer';
    controlUI.style.marginBottom = '22px';
    controlUI.style.textAlign = 'center';
    controlUI.style.width = '140px';
    controlUI.style.height = '38px';
    controlUI.style.marginTop = '10px';
    controlDiv.appendChild(controlUI);

    // Set CSS for the control interior.
    var text_prop = document.createElement('div');
    text_prop .style.color = 'rgb(0,0,0)';
    text_prop .style.fontFamily = 'Roboto,Arial,sans-serif';
    text_prop .style.fontSize = '8px';
    text_prop .style.lineHeight = '10px';
    text_prop .style.paddingLeft = '5px';
    text_prop .style.paddingRight = '5px';
    text_prop .style.position = 'absolute';
    text_prop .style.top = '33px';
    text_prop .innerHTML = 'prop';
    controlUI.appendChild(text_prop );

    var prop = document.createElement('div');
    prop.style.border = '0px solid #fff';
    prop.style.height = '20px';
    prop.style.width = '20px';
    prop.style.backgroundColor = '#0087FF';
    prop.style.boxShadow = '0 2px 6px rgba(255,0,0,.3)';
    prop.style.cursor = 'pointer';
    prop.style.marginBottom = '22px';
    prop.style.borderRadius = '100%';
    prop.style.textAlign = 'center';
    prop.style.position = 'absolute';
    prop.style.top = '13px';
    prop.style.left = '5px';
    prop.title = 'Filtreaza dupa proprietari.';
    controlDiv.appendChild(prop);

    // Set CSS for the control interior.
    var text_broker = document.createElement('div');
    text_broker.style.color = 'rgb(0,0,0)';
    text_broker.style.fontFamily = 'Roboto,Arial,sans-serif';
    text_broker.style.fontSize = '8px';
    text_broker.style.lineHeight = '10px';
    text_broker.style.paddingLeft = '5px';
    text_broker.style.paddingRight = '5px';
    text_broker.style.position = 'absolute';
    text_broker.style.top = '33px';
    text_broker.style.left = '40px';
    text_broker.innerHTML = 'broker';
    controlUI.appendChild(text_broker);

    var broker = document.createElement('div');
    broker.style.border = '0px solid #fff';
    broker.style.height = '20px';
    broker.style.width = '20px';
    broker.style.backgroundColor = '#FFB300';
    broker.style.boxShadow = '0 2px 6px rgba(255,0,0,.3)';
    broker.style.cursor = 'pointer';
    broker.style.marginBottom = '22px';
    broker.style.borderRadius = '100%';
    broker.style.textAlign = 'center';
    broker.style.position = 'absolute';
    broker.style.top = '13px';
    broker.style.left = '48px';
    broker.title = 'Filtreaza dupa brokeri.';
    controlDiv.appendChild(broker);

    // Set CSS for the control interior.
    var text_banca = document.createElement('div');
    text_banca.style.color = 'rgb(0,0,0)';
    text_banca.style.fontFamily = 'Roboto,Arial,sans-serif';
    text_banca.style.fontSize = '8px';
    text_banca.style.lineHeight = '10px';
    text_banca.style.paddingLeft = '5px';
    text_banca.style.paddingRight = '5px';
    text_banca.style.position = 'absolute';
    text_banca.style.top = '33px';
    text_banca.style.left = '87px';
    text_banca.innerHTML = 'banca';
    controlUI.appendChild(text_banca);

    var banca = document.createElement('div');
    banca.style.border = '0px solid #fff';
    banca.style.height = '20px';
    banca.style.width = '20px';
    banca.style.backgroundColor = '#f00';
    banca.style.boxShadow = '0 2px 6px rgba(255,0,0,.3)';
    banca.style.cursor = 'pointer';
    banca.style.marginBottom = '22px';
    banca.style.borderRadius = '100%';
    banca.style.textAlign = 'center';
    banca.style.position = 'absolute';
    banca.style.top = '13px';
    banca.style.left = '97px';
    banca.title = 'Filtreaza dupa banci.';
    controlDiv.appendChild(banca);

    return {
        banca: banca,
        prop: prop,
        broker: broker
    }
}

class GMap{
    public map : any;
    public params : IMapParams;
    public selected_shape : any;
    public pops : Array<any> = [];
    constructor(public poly_btn: string, public hand_btn:string, public trash_btn: string){
        this.params = {
            zoom: 12,
            center: new google.maps.LatLng(44.42684, 26.1025),
            disableDefaultUI: false,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER
            },
            scaleControl: true,
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER
            },
            panControl: true,
            panControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_TOP
            }
        }
        _that  = this;
        shapes = [];
        this.selected_shape = null;
    }

    legend = (cbBanca, cbBroker, cbProp) : void => {
        var centerControlDiv = document.createElement('div');
        var centerControl = CenterControl(centerControlDiv, this.getMap());
        centerControl.banca.addEventListener('click', cbBanca)
        centerControl.prop.addEventListener('click', cbProp)
        centerControl.broker.addEventListener('click', cbBroker)
        this.getMap().controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
    }

    banca = () => {
        console.log('banca');
    }

    broker = () => {

    }

    prop = () => {
        console.log('prop');
    }




    clearShapes = (tab?:number):void => {
        console.log('clear');
        for (var i = 0; i < shapes.length; ++i) {
            shapes[i].setMap(null);
        }
        shapes = [];
        disableElement('#btnPolygon',false);

        if(tab){
            this.activateTab(tab);
        }
    }

    disableDrawingControl = ():void => {
        drawman.drawingControl=false;
        disableElement('#btnPolygon',true);
        $('#btnHand').click();
    }

    hanlders = ():void => {
        $('#'+this.poly_btn).click(function(){
            drawman.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
        });
        $('#'+this.hand_btn).click(function(){
            drawman.setDrawingMode(google.maps.drawing.OverlayType.POINTER_MOUSE);
        });
        $('#'+this.trash_btn).click(function(){
            _that.clearShapes();
        });
        google.maps.event.addDomListener(drawman,'polygoncomplete',this.disableDrawingControl);
        google.maps.event.addDomListener(drawman, 'overlaycomplete', function(e) {
            var shape = e.overlay;
            shape.type = e.type;
            shapes.push(shape);
        });
    }

    init = ():void => {
        this.map = new google.maps.Map(document.getElementById('map_in'), this.params);
        drawman = new google.maps.drawing.DrawingManager({
            map: this.map,
            polygonOptions: {editable:true,fillColor: _config["polygonColor"],strokeColor: _config["polygonColor"],strokeWeight:2},
            drawingControl: false
        });
    }

    activateTab = (nr?:number):void => {
        $('a[data-toggle=tab]:eq('+( nr - 1 )+')').tab('show')
    }

    getGeometry = (hash : boolean):string => {
        /*if hash == true ==> return hash result, not plain text*/
        return JSON.stringify(IO.IN(shapes, hash))
    }

    hasPolygon = ():boolean => {
        return !(IO.IN(shapes, true).length == 0);
    }

    getMap = ():any => {
        return this.map;
    }

    drawPolygon = (coords:string, color?: string):any => {
        var tmp = new google.maps.Polygon({
            paths: IO.mm_(coords[0]['geometry']),
            strokeColor: color,
            strokeOpacity: 1.0,
            fillOpacity: 0.35,
            position:IO.mm_.apply(IO,coords[0]['geometry']),
            editable: true
        });
        shapes.push(tmp);
        tmp.setMap(this.map);
        return tmp;
    }

    getPolygonCenter = (polygon:any):any => {
        var bounds = new google.maps.LatLngBounds();
        var points = polygon.getPath().getArray();

        for (var n = 0; n < points.length ; n++){
            bounds.extend(points[n]);
        }
        var lat = bounds.getCenter().lat(),
            long = bounds.getCenter().lng();
        return bounds.getCenter();
    }

    setMapCenter = (center: any):void => {
        this.map.setCenter(center);
    }

    zoomToObject = function(obj) {
        var bounds = new google.maps.LatLngBounds();
        var points = obj.getPath().getArray();

        for (var n = 0; n < points.length; n++) {
            bounds.extend(points[n]);
        }
        console.log(bounds.getCenter().lng());
        var lat = bounds.getCenter().lat(),
            long = bounds.getCenter().lng();
        _that.map.setCenter(bounds.getCenter());
    }

    addPop = (info) => {
        _that.pops.push(info);
    }

    clearPops = () => {
        _that.pops.map((el) => {
            el.close();
        });
    }




}

var gmap = new GMap('btnPolygon','btnHand','clear_shapes');
gmap.init();
gmap.hanlders();
google.maps.event.addListener(gmap.getMap, "zoom_changed", function() {
    if (gmap.getZoom() > 13) poly.setMap(null);
    else poly.setMap(map);
});
function disableElement(id,value){
    $(id).prop('disabled', value);
    if(value){
        $(id).addClass('disabled');
    }else{
        $(id).removeClass('disabled');
    }
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
            tmp.type = 'POLYGON';
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
    OUT: function(
        arr, //array containg the stored shape-definitions
        map,//map where to draw the shape
        shapeColor
    ) {
        shapes=[];
        var goo = google.maps,
            map = map || null,
            shape, tmp;
        for (var i = 0; i < arr.length; i++) {
            shape = arr[i];
            //shape.type = 'POLYGON';
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
                    break;
            }
            shapes.push(tmp);
        }
        //var clusterer = new MarkerClusterer(map, shapes);
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