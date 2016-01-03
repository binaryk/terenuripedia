var shapes;
var _that;
var GMap = (function () {
    function GMap(poly_btn, hand_btn, trash_btn) {
        var _this = this;
        this.poly_btn = poly_btn;
        this.hand_btn = hand_btn;
        this.trash_btn = trash_btn;
        this.clearShapes = function () {
            for (var i = 0; i < shapes.length; ++i) {
                shapes[i].setMap(null);
            }
            shapes = [];
            disableElement('#btnPolygon', false);
        };
        this.disableDrawingControl = function () {
            drawman.drawingControl = false;
            disableElement('#btnPolygon', true);
            $('#btnHand').click();
        };
        this.hanlders = function () {
            $('#' + _this.poly_btn).click(function () {
                console.log('asdasd');
                drawman.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
            });
            $('#' + _this.hand_btn).click(function () {
                drawman.setDrawingMode(google.maps.drawing.OverlayType.POINTER_MOUSE);
            });
            $('#' + _this.trash_btn).click(function () {
                _that.clearShapes();
            });
            google.maps.event.addDomListener(drawman, 'polygoncomplete', _this.disableDrawingControl);
            google.maps.event.addDomListener(drawman, 'overlaycomplete', function (e) {
                var shape = e.overlay;
                shape.type = e.type;
                shapes.push(shape);
            });
        };
        this.init = function () {
            _this.map = new google.maps.Map(document.getElementById('map_in'), _this.params);
            drawman = new google.maps.drawing.DrawingManager({
                map: _this.map,
                polygonOptions: { editable: true, fillColor: _config["polygonColor"], strokeColor: _config["polygonColor"], strokeWeight: 2 },
                drawingControl: false
            });
        };
        this.params = {
            zoom: 12,
            center: new google.maps.LatLng(44.42684, 26.1025),
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
        };
        _that = this;
        shapes = [];
        this.selected_shape = null;
    }
    return GMap;
})();
var gmap = new GMap('btnPolygon', 'btnHand', 'clear_shapes');
gmap.init();
gmap.hanlders();
function disableElement(id, value) {
    $(id).prop('disabled', value);
    if (value) {
        $(id).addClass('disabled');
    }
    else {
        $(id).removeClass('disabled');
    }
}
var IO = {
    //returns array with storable google.maps.Overlay-definitions
    IN: function (arr, //array with google.maps.Overlays
        encoded //boolean indicating whether pathes should be stored encoded
        ) {
        var shapes = [], goo = google.maps, shape, tmp;
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
    OUT: function (arr, //array containg the stored shape-definitions
        map, //map where to draw the shape
        shapeColor) {
        shapes = [];
        var goo = google.maps, map = map || null, shape, tmp;
        for (var i = 0; i < arr.length; i++) {
            shape = arr[i];
            switch (shape.type) {
                case 'POLYGON':
                    tmp = new goo.Polygon({
                        paths: this.mm_(shape.geometry),
                        strokeColor: shapeColor,
                        strokeOpacity: 1.0,
                        fillColor: shapeColor,
                        fillOpacity: 0.35,
                        position: this.mm_.apply(this, shape.geometry),
                    });
                    tmp.getPosition = function () {
                        var lastPath = null, lastCenter = null;
                        var path = this.getPath();
                        if (lastPath == path) {
                            return lastCenter;
                        }
                        lastPath = path;
                        var bounds = new google.maps.LatLngBounds();
                        path.forEach(function (latlng, i) {
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
    l_: function (path, e) {
        path = (path.getArray) ? path.getArray() : path;
        if (e) {
            return google.maps.geometry.encoding.encodePath(path);
        }
        else {
            var r = [];
            for (var i = 0; i < path.length; ++i) {
                r.push(this.p_(path[i]));
            }
            return r;
        }
    },
    ll_: function (path) {
        if (typeof path === 'string') {
            return google.maps.geometry.encoding.decodePath(path);
        }
        else {
            var r = [];
            for (var i = 0; i < path.length; ++i) {
                r.push(this.pp_.apply(this, path[i]));
            }
            return r;
        }
    },
    m_: function (paths, e) {
        var r = [];
        paths = (paths.getArray) ? paths.getArray() : paths;
        for (var i = 0; i < paths.length; ++i) {
            r.push(this.l_(paths[i], e));
        }
        return r;
    },
    mm_: function (paths) {
        var r = [];
        for (var i = 0; i < paths.length; ++i) {
            r.push(this.ll_.call(this, paths[i]));
        }
        return r;
    },
    p_: function (latLng) {
        return ([latLng.lat(), latLng.lng()]);
    },
    pp_: function (lat, lng) {
        return new google.maps.LatLng(lat, lng);
    },
    b_: function (bounds) {
        return ([this.p_(bounds.getSouthWest()), this.p_(bounds.getNorthEast())]);
    },
    bb_: function (sw, ne) {
        return new google.maps.LatLngBounds(this.pp_.apply(this, sw), this.pp_.apply(this, ne));
    },
    t_: function (s) {
        var t = ['CIRCLE', 'MARKER', 'RECTANGLE', 'POLYLINE', 'POLYGON'];
        for (var i = 0; i < t.length; ++i) {
            if (s === google.maps.drawing.OverlayType[t[i]]) {
                return t[i];
            }
        }
    }
};
//# sourceMappingURL=GMap.js.map