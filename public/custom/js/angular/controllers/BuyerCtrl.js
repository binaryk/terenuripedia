app.controller(
    'BuyerCtrl', ['$scope', '$http', '$rootScope','$compile', 'TerrainService', '$timeout','$http',
        function BuyerCtrl($scope, $http, $rootScope, $compile, TerrainService, $timeout) {
            var scope = $rootScope;
            var cautare = true;
            var f_title = '';

            $scope.infoWindow;

            $scope.price = {
                min: 0,
                max: 80
            };

            $scope.suprafata = {
                min: 0,
                max: 80
            };

            $scope.searchTerrains = [];
            $scope.shapes=[];
            $scope.currentTerrain={};

            console.log('BuyerCtrl.js');

            //scope.$watch('config', function(n, o){
                TerrainService.get().then(function(data){
                    console.log(data.data);
                    $scope.searchTerrains = data.data;
                   $timeout(function(){
                       $scope.getAllShapes();
                   });
                    $compile($('.my_form').contents())($scope);
                });
            //});

            $scope.select = function(terrain){
                $scope.currentTerrain=terrain;
                

                _config['current_terrain'] = terrain;
                console.log(terrain);
                clearShapes();
                var coords = JSON.parse(terrain.geometry),
                    coords_text = JSON.parse(terrain.geometry_text);
                console.log(coords_text[0]);
                var tmp = new goo.Polygon({
                    paths: IO.mm_(coords[0]['geometry']),
                    strokeColor: terrain.color_text,
                    strokeOpacity: 1.0,
                    fillOpacity: 0.35,
                    position:IO.mm_.apply(IO,coords[0]['geometry']),
                });
                tmp.addListener('click', $scope.showArrays);
                tmp.setMap(map_in);
                $scope.zoomToObject(tmp);
                IO.OUT(coords,map_in, terrain.color_text);
                $scope.infoWindow = new goo.InfoWindow;
                //map_in.setCenter();
            }

            /** @this {google.maps.Polygon} */
            $scope.showArrays = function(event) {
                alert(3);
                // Since this polygon has only one path, we can call getPath() to return the
                // MVCArray of LatLngs.
                var vertices = this.getPath();

                var contentString = '<b>Bermuda Triangle polygon</b><br>' +
                    'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
                    '<br>';

                // Iterate over the vertices.
                for (var i =0; i < vertices.getLength(); i++) {
                    var xy = vertices.getAt(i);
                    contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
                        xy.lng();
                }

                // Replace the info window's content and position.
                infoWindow.setContent(contentString);
                infoWindow.setPosition(event.latLng);

                infoWindow.open(map);
            }

            $scope.zoomToObject = function(obj){
                var bounds = new google.maps.LatLngBounds();
                var points = obj.getPath().getArray();

                for (var n = 0; n < points.length ; n++){
                    bounds.extend(points[n]);
                }
                console.log(bounds.getCenter().lng());
                var lat = bounds.getCenter().lat(),
                    long = bounds.getCenter().lng();
                map.setCenter(bounds.getCenter());
                //goo.event.trigger(map,'resize');
                //initialize_search(false, bounds.getCenter());
                //map_in.setCenter(new google.maps.LatLng(50, 44));
               /* map_in.fitBounds(bounds);
                setTimeout(function() {
                    google.maps.event.trigger(map_in,'resize');
                    map_in.fitBounds(bounds);
                }, 200);*/
            }

            $scope.getAllShapes=function(){
                angular.forEach($scope.searchTerrains, function(value, key) {
                    this.push(JSON.parse(value.geometry)[0]);
                    var coords = JSON.parse(value.geometry);
                    //IO.OUT(coords,map_in, value.color_text);
                }, $scope.shapes);
                IO.OUT($scope.shapes,map_in);
            };

            $scope.byRange = function (fieldName, minValue, maxValue) {
                if (minValue === undefined) minValue = -1000;
                if (maxValue === undefined || minValue>maxValue) maxValue = Number.MAX_VALUE;
                minValue=Number(minValue);
                maxValue=Number(maxValue);
                return function predicateFunc(item) {
                    return minValue <= Number(item[fieldName]) && Number(item[fieldName]) <= maxValue;
                };
            };

        }]);


app.filter('byOwner', function() {
    // Create the return function and set the required parameter name to **input**
    return function(input, type_id) {
        var out = [];
        // Using the angular.forEach method, go through the array of data and perform the operation of figuring out if the language is statically or dynamically typed.
        angular.forEach(input, function(node) {
            if(node.owner != null && type_id){
                if(type_id == node.owner.type_id){
                    out.push(node)
                }
            }else{
                out.push(node)
            }
        });
        return out;
    }
});


