app.controller(
    'BuyerCtrl', ['$scope', '$http', '$rootScope','$compile', 'TerrainService', '$timeout','$http',
        function BuyerCtrl($scope, $http, $rootScope, $compile, TerrainService, $timeout) {
            var scope = $rootScope;
            var cautare = true;
            var f_title = '';
            $scope.P_MIN   = 0;
            $scope.P_MAX   = Number.MAX_SAFE_INTEGER;
            $scope.S_MIN   = 0;
            $scope.S_MAX   = Number.MAX_SAFE_INTEGER;
            $scope.length_result = 0;

            $scope.price = {
                min: $scope.P_MIN,
                max: $scope.P_MAX
            };

            $scope.suprafata = {
                min: $scope.S_MIN,
                max: $scope.S_MAX
            };
            $scope.searchTerrains = [];
            $scope.shapes=[];
            $scope.currentTerrain={};
            TerrainService.get().then(function(data){
                console.log(data.data);
                $scope.searchTerrains = data.data;
                $scope.length_result  = data.data.length;
                $scope.bindFn();
            });

            $scope.bindFn = function(){
                gmap.legend($scope.banca, $scope.broker, $scope.prop);

            }

            $scope.banca = function(){
                gmap.clearShapes();
                $scope.searchTerrains.map(function(el){
                    if(el.owner && el.owner.type_id == 3){
                        $scope.select(el);
                    }else{
                        el.selected = false;
                    }
                });
                $timeout(function(){
                    $scope.$apply();
                });
                //    '1' => 'Proprietar',// - asignat cu culoarea albastra
                //    '2' => 'Broker',// - Galben
                //    '3' => 'Banca',// - Rosu
            }

            $scope.broker = function(){
                gmap.clearShapes();
                $scope.searchTerrains.map(function(el){
                    if(el.owner && el.owner.type_id == 2){
                        $scope.select(el);
                    }else{
                        el.selected = false;
                    }
                });
                $timeout(function(){
                    $scope.$apply();
                });
            }

            $scope.prop = function(){
                gmap.clearShapes();
                console.log('Filtered by prop');
                $scope.searchTerrains.map(function(el){
                    if(el.owner && el.owner.type_id == 1){
                        $scope.select(el);
                    }else{
                        el.selected = false;
                    }
                });
                $timeout(function(){
                    $scope.$apply();
                });

            }

            $scope.showArrays = function(event, id) {
                gmap.clearPops();
                infoWindow = new google.maps.InfoWindow;
                gmap.addPop(infoWindow);
                TerrainService.info(id).then(function(data){
                    var contentString = data;
                    infoWindow.setContent(contentString);
                    infoWindow.setPosition(event.latLng);
                    infoWindow.open(gmap.map);
                    init_carouser();
                    $compile($('#info_tab').contents())($scope)
                });

            }

            $scope.debloc = function ($id) {
                console.log($id);
                TerrainService.open($id).then(function(data){
                    console.log(data);
                    $scope.credit = data.credit;
                    $scope.$parent.mc.credit = data.credit;
                    if($id == false){
                        bootbox.dialog({
                            title: "Atentie",
                            message: data.msg
                        });
                    }else{
                        if(data.code == 200 && $id){
                            $('#base_telefon').html(data.telefon).css('color','#264165');
                            $('.rdeblocheaza').remove();
                        } else{
                            bootbox.dialog({
                                title: "Atentie",
                                message: 'Trebuie sa aveti minim 4.5 RON credit.'
                            });
                        }
                    }

                });
            }

            $scope.refresh_credit = function(terrain){
                $scope.drawAll();
                gmap.clearPops();
                $scope.debloc(false);
            }

            $scope.drawAll = function(){
                gmap.clearShapes()
                $scope.searchTerrains.map(function(terrain){
                    if(terrain.selected){
                        var coords = JSON.parse(terrain.geometry),
                            coords_text = JSON.parse(terrain.geometry_text);
                        tmp = gmap.drawPolygon(coords, terrain.color_text);
                        gmap.zoomToObject(tmp);
                        google.maps.event.addListener(tmp, 'click', function (event) {
                            $scope.showArrays(event, terrain.id);
                        });
                        document.EL = tmp;
                    }
                });
            }

            $scope.select = function(terrain){
                terrain.selected = !terrain.selected;
                gmap.clearPops();
                $scope.currentTerrain=terrain;
                _config['current_terrain'] = terrain;
                $scope.drawAll();
            }



   /*         $scope.getAllShapes=function(){
                angular.forEach($scope.searchTerrains, function(value, key) {
                    this.push(JSON.parse(value.geometry)[0]);
                    var coords = JSON.parse(value.geometry);
                    IO.OUT(coords,map_in, value.color_text);
                }, $scope.shapes);
                $timeout(function(){
                    IO.OUT($scope.shapes,map_in);
                });
            };*/

            $scope.byRange = function (fieldName, minValue, maxValue) {
                if (minValue === undefined) minValue = -1000;
                if (maxValue === undefined || minValue>maxValue) maxValue = Number.MAX_VALUE;
                minValue=Number(minValue);
                maxValue=Number(maxValue);
                return function predicateFunc(item) {
                    return minValue <= Number(item[fieldName]) && Number(item[fieldName]) <= maxValue;
                };
            };

            $scope.clear = function(){
                $scope.price.min = $scope.P_MIN;
                $scope.price.max = $scope.P_MAX;
                $scope.suprafata.min = $scope.S_MIN;
                $scope.suprafata.max = $scope.S_MAX;
                $timeout(function(){
                    $('select').val('').trigger('change')
                });
            }

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


