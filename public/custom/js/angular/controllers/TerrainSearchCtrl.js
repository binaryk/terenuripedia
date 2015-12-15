app.controller(
    'TerrainSearchCtrl', ['$scope', '$http', '$rootScope','$compile', 'TerrainService', '$timeout','$http',
        function TerrainSearchCtrl($scope, $http, $rootScope, $compile, TerrainService, $timeout) {
            var scope = $rootScope;
            var cautare = true;
            var f_title = '';

            $scope.searchTerrains = [];
            $scope.shapes=[];
            $scope.currentTerrain={};

            console.log('TerrainSearchCtrl.js');

            scope.$watch('config', function(n, o){
                TerrainService.get().then(function(data){
                    console.log(data.data);
                    $scope.searchTerrains = data.data;
                    $scope.getAllShapes();
                    $compile($('.my_form').contents())($scope);
                });
            });

            $scope.getAllShapes=function(){
                angular.forEach($scope.searchTerrains, function(value, key) {
                    this.push(JSON.parse(value.geometry)[0]);
                }, $scope.shapes);
                IO.OUT($scope.shapes,map_in,_config["polygonColor"]);
            };

            $scope.click = function(item){

                $scope.currentTerrain=item;
                console.log(item);
                _config['current_terrain'] = item;
                var coords = JSON.parse(item.geometry);
                console.log(coords);
                console.log(map_in);
                initialize_search();
                IO.OUT(coords,map_in, _config["polygonColor"]);
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


