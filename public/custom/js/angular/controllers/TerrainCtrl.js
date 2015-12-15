app.controller(
            'TerrainCtrl', ['$scope', '$http', '$rootScope','$compile', 'TerrainService', '$timeout','FormService','$http', 
    function TerrainCtrl($scope, $http, $rootScope, $compile, TerrainService, $timeout,FormService) {
    var scope = $rootScope;
    var cautare = true;
    var f_title = '';
    $scope.classSourceControls = '.data-source';
    $scope.edit = false;

    $scope.terrains = [];
    $scope.currentTerrain;
    console.log('TerrainCtrl.js');    

    scope.$watch('config', function(n, o){
        TerrainService.getUserTerrains().then(function(data){
            console.log(data.data);
            $scope.terrains = data.data;
            $compile($('.my_form').contents())($scope);
        });
    });   

    $scope.add_ = function () {
      console.log('add');
      $scope.currentTerrain=null;
      $scope.edit          = false;
      $('#clear_shapes').click();
      //toastr.info('Intorduceți datele pentru acest teren.');

    }

    $scope.saveTerrain = function(){
        var data = FormService.datasource();
        var tc   = new Terrain([{d: 0}]);
        var geometry = JSON.stringify(IO.IN(shapes, true));
        if(IO.IN(shapes, true).length == 0){
          toastr.error("Vă rugăm să desenați terenul.")
        }else{
          data['geometry'] = geometry;
          if($scope.edit){
            TerrainService.put($scope.currentTerrain.id, data).then(function(data){
              swal('Succes!', 'Datele au fost actualizate cu succes.', 'success');
            });
          }else{
            TerrainService.store(data).then(function(data){
              $scope.terrains.push(data.out);
              swal('Succes!', 'Datele au fost salvate cu succes. Acum puteți vizualiza terenul în listă.', 'success');
            });
            FormService.emptyControls();
          }
        }


    };

    $scope.editTerrain = function(item){
      console.log('edit');
        $scope.currentTerrain=item;
        $scope.edit          = true;
        var coords = JSON.parse(item.geometry);
        initialize();
        IO.OUT(coords,map_in, _config["polygonColor"]);
        $timeout(function(){
          $scope.init_on_update(item);
        }, 1000)
        /*TerrainService.edit(item.id).then(function(data){

        });*/
        /*la editare nu trebuie sa putem adauga polyline*/
        drawman.drawingControl=false;
        disableElement('#btnPolygon',true);
        $('#btnHand').click();
    };

    $scope.deleteTerrain=function(item){
      swal({   title: "Sunteti sigur?",
            text: "Doriti sa ștergeți această secțiune ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "DA, sunt sigur!",
            cancelButtonText: "NU, inchide!",
            closeOnConfirm: false,
            closeOnCancel: false },
          function(isConfirm){
            if (isConfirm) {
              $timeout(function(){
                TerrainService.destroy(item.id, data).then(function(data){
                  var index = $scope.terrains.indexOf(item);
                  $scope.terrains.splice(index, 1);
                  swal('Succes!', 'Terenul a fost sters.', 'success');
                });
              }, 200);
            }
            else {
              swal("Cancelled", "Terenul nu a fost ștears.", "error");
            }
          });




    };
      $scope.init_on_update = function (node) {
        var controls   = $($scope.classSourceControls);
        if( controls.length > 0)
        {

          angular.forEach(controls , function(control, key){
            switch( $(control).data('control-type') )
            {
              case 'combobox' :
                document.getElementById($(control).data('control-source')).selectedIndex = node[$(control).data('control-source')];
                  //$(control).val($scope.currentTerrain[$(control).data('control-source')]).trigger('change');
                break;
            }
          });
        }
        //document.getElementById("id_locatie").selectedIndex = node.id_locatie;
      }
}]);

