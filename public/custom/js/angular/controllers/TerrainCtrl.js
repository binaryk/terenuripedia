const CLASS_SOURCE_CONTROL = '.data-source';
const FORM = '.my_form';
const MESSAGES = {
  INSERT      : 'Intorduceți datele pentru acest teren.',
  DRAW        : 'Vă rugăm să desenați terenul',
  REMOVE      : 'Stergeti terenul ',
  EDIT        : 'Editati terenul '
}
app.controller(
            'TerrainCtrl', ['$scope', '$http', '$rootScope','$compile', 'TerrainService', '$timeout','FormService','$http', 
    function TerrainCtrl($scope, $http, $rootScope, $compile, TerrainService, $timeout,FormService) {
    $scope.terrains = []
    $scope.EDIT     = false;
    $scope.currentTerrain;
    $rootScope.$watch('config', function(n, o) {
      TerrainService.getUserTerrains().then(function (data) {
        $scope.terrains = data.data;
        $compile($(FORM).contents())($scope);
      });
    });

    $scope.add = function () {
      $scope.currentTerrain = null;
      $scope.EDIT           = false;
      FormService.safe( FormService.emptyControls );
      gmap.clearShapes(2);
      toastr.info(MESSAGES.INSERT);
    }

    $scope.WriteAction = function(){
      var data;
      if(!gmap.hasPolygon()){
          toastr.error(MESSAGES.DRAW)
      }else
      {
          data = FormService.datasource();
          data['geometry']      = gmap.getGeometry(true);
          data['geometry_text'] = gmap.getGeometry(false);
          if($scope.EDIT){
            $scope.PUT(data);
          }else{
            $scope.STORE(data);
          }
      }


    };

    $scope.PUT = function(data){
        TerrainService.put($scope.currentTerrain.id, data).then(function(data){
          if( ! data.success)
          {
            FormService.removeFieldsErrors();
            FormService.showFieldsErrors(data.messages);
            toastr.error(data.alert.message)
            gmap.activateTab(3);
          }
          else
          {
            swal(data.alert.caption, data.alert.message, data.alert.type);
            gmap.clearShapes(1);
            $scope.currentTerrain.geometry = data.node.geometry;
            $scope.currentTerrain.characteristics = data.node.characteristics;
            $scope.currentTerrain = null;
            FormService.safe( FormService.emptyControls );
          }
        });
    }

    $scope.STORE = function(data){

      TerrainService.store(data).then(function(data){
        if( ! data.success)
        {
          FormService.removeFieldsErrors();
          FormService.showFieldsErrors(data.messages);
          toastr.error(data.alert.message)
          gmap.activateTab(3);
        }else{
          FormService.removeFieldsErrors();
          toastr.success('Datele au fost salvate cu succes!');
          $scope.terrains.push(data.out);
          /*
            salvez id-ul, pentru a-l prelua la fileinput
            $('#inserted_terrain').val(data.out.id);
           */
          gmap.activateTab(1);
          gmap.clearShapes();
          FormService.safe( FormService.emptyControls );
          $scope.currentTerrain = null;
        }
      });

    }

    $scope.edit = function(item){
        $scope.currentTerrain=item;
        $scope.EDIT          = true;
        var coords = JSON.parse(item.geometry);
        gmap.clearShapes();
        var polygon= gmap.drawPolygon(coords,item.color_text);
        gmap.setMapCenter( gmap.getPolygonCenter( polygon ) );
        $scope.safe( $scope.init_on_update, item, gmap.activateTab, 3 );
        gmap.disableDrawingControl();
        toastr.info(MESSAGES.EDIT + '<strong><u>' + item.title + '</u></strong>')
    };

    $scope.deleteTerrain=function(item){
      bootbox.confirm(MESSAGES.REMOVE + '<strong><u>'+ item.title + '</u></strong> ?', function(result) {
         if(result){
             TerrainService.destroy(item.id, data).then(function(data){
               var index = $scope.terrains.indexOf(item);
               $scope.terrains.splice(index, 1);
             });
         }
      });
    };

    $scope.init_on_update = function (node) {
      var controls   = $(CLASS_SOURCE_CONTROL);
      if( controls.length > 0)
      {
        angular.forEach(controls , function(control, key){
          switch( $(control).data('control-type') )
          {
            case 'combobox' :
                if($scope.currentTerrain){
                  if($(control).attr('multiple')){
                    var values = [];
                    angular.forEach($scope.currentTerrain[$(control).attr('id')], function(obj, index){
                      values.push(obj.id);
                    })
                    $(control).val(values).trigger('change');
                  }else{
                    $(control).val($scope.currentTerrain[$(control).data('control-source')]).trigger('change');
                  }

                }
                else{
                  $(control).select2('val','');
                }
              break;
            case 'radiobox':

              break;
          }
        });
      }
    }

      $scope.safe = function(cb, param, alter, a_param){
        $timeout(function(){
          cb(param);
          if(alter){
            alter(a_param);
          }
        },300);
      }
}]);

