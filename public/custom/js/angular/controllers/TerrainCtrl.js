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

    $scope.add = function () {
      $scope.currentTerrain=null;
      $timeout(function(){
        $scope.init_on_update(null);
      }, 500)
      $scope.edit          = false;

      $('#clear_shapes').click();
      toastr.info('Intorduceți datele pentru acest teren.');
      $('a[href=#data]').click();
    }

    $scope.saveTerrain = function(){
        var data = FormService.datasource();
        var geometry = JSON.stringify(IO.IN(shapes, true));
        var geometry_text = JSON.stringify(IO.IN(shapes, false));
        if(IO.IN(shapes, true).length == 0){
          toastr.error("Vă rugăm să desenați terenul.")
        }else{
          data['geometry'] = geometry;
          data['geometry_text'] = geometry_text;
          
          if($scope.edit){
            TerrainService.put($scope.currentTerrain.id, data).then(function(data){
              swal('Succes!', 'Datele au fost actualizate cu succes.', 'success');
              $('a[href=#lista]').click();
              $('#clear_shapes').click();
              console.log(data);
              $scope.currentTerrain.geometry = geometry;
              $scope.currentTerrain.characteristics = data.node.characteristics;
              $scope.currentTerrain = null;
            });
          }else{
            TerrainService.store(data).then(function(data){
              $scope.terrains.push(data.out);
              /*salvez id-ul, pentru a-l prelua la fileinput*/
              $('#inserted_terrain').val(data.out.id);
              swal('Succes!', 'Datele au fost salvate cu succes. Acum puteți vizualiza terenul în listă.', 'success');
              $('a[href=#lista]').click();
              $('#clear_shapes').click();
              $timeout(function(){
                uploadAsincImage();
              });
            });
          }
          $timeout(function(){
            $scope.init_on_update(null);
          }, 500);
          FormService.emptyControls();
        }


    };

    $scope.editTerrain = function(item){
      $scope.currentTerrain=item;
        $scope.edit          = true;
        var coords = JSON.parse(item.geometry);
        console.log(item.photo);
        initialize();
        IO.OUT(coords,map_in, _config["polygonColor"]);
        $timeout(function(){
          $scope.init_on_update(item);
        }, 500)
        /*la editare nu trebuie sa putem adauga polyline*/
        drawman.drawingControl=false;
        disableElement('#btnPolygon',true);
        $('#btnHand').click();
        $('a[href=#proiect]').click();
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
                //document.getElementById($(control).data('control-source')).selectedIndex = node[$(control).data('control-source')];
                  if($scope.currentTerrain){
                    if($(control).attr('multiple')){
                      console.log($scope.currentTerrain[$(control).attr('id')]);
                      var values = [];
                      angular.forEach($scope.currentTerrain[$(control).attr('id')], function(obj, index){
                        values.push(obj.id);
                      })
                      console.log(values);

                      $(control).val(values).trigger('change');
                    }else{
                      $(control).val($scope.currentTerrain[$(control).data('control-source')]).trigger('change');
                    }

                  }

                  else
                    $(control).select2('val',1);//.trigger('change');
                break;
              case 'radiobox':

                break;
            }
          });
        }
      }
}]);

