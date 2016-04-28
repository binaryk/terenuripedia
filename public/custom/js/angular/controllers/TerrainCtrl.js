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
    $scope.ADD      = false;
    $scope.currentTerrain;
    $rootScope.$watch('config', function(n, o) {
      TerrainService.getUserTerrains().then(function (data) {
        $scope.terrains = data.data;
        $compile($(FORM).contents())($scope);
      });
    });

    $scope.add = function () {
      $scope.currentTerrain = null;
      $timeout( initPret, 500);
      $scope.EDIT           = false;
      $scope.ADD            = true;
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
          data['user_owner'] = $('#user_owner').val();
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
          $scope.EDIT            = false;
          swal(data.alert.caption, data.alert.message, data.alert.type);
            gmap.clearShapes(1);
            $scope.currentTerrain.geometry = data.node.geometry;
            $scope.currentTerrain.characteristics = data.node.characteristics;
            $scope.currentTerrain.localitate = data.node.localitate;
            $scope.currentTerrain = null;
            FormService.safe( FormService.emptyControls );
          }
        });
    }

    $scope.STORE = function(data){
      TerrainService.store(data).then(function(data){
      console.log(data);
        if( ! data.success)
        {
          FormService.removeFieldsErrors();
          FormService.showFieldsErrors(data.messages);
          toastr.error(MESSAGES.INSERT)
          gmap.activateTab(3);
        }else{
            $scope.ADD            = false;
            var photos = [];
            if(file_document){
                $('#inserted_terrain').val(data.out.id);
                file_document.on('fileuploaded', function(event, data, previewId, index){
                    photos.push(data.response.photo);
                });
                file_document.fileinput('upload');
                file_document.fileinput('clear');
            }
            FormService.removeFieldsErrors();
          toastr.success(data.message);

          if(! data.has_abonament && ! _config['isAdmin']){
              $scope.credit = data.credit;
              $scope.$parent.mc.credit = data.credit;

              bootbox.dialog({
              title: "Atentie",
              message: 'PRIN ADAUGAREA ACESTUI TEREN DIN CONTUL DVS AU FOST EXTRASI 18.72.'
            });
          }
          $timeout(function(){
              data.out.photos = photos;
              $scope.terrains.push(data.out);
          },1000);
          gmap.activateTab(1);
          gmap.clearShapes();
          FormService.safe( FormService.emptyControls );
          $scope.currentTerrain = null;
        }
      });

    }

    $scope.removePhoto = function(photo){
        var afirm = new App.Afirm();
        afirm.question('Atentie','Sigur doriti sa stergeti definitiv poza ?');
        afirm.onConfirm = destroy.bind(this,photo);

    }

    var destroy = function(photo){
        var index  = $scope.currentTerrain.photos.indexOf(photo);
        TerrainService.destroyPhoto(photo).then(function(data){
            if(data.code == 200){
                afirm.success(data.msg);
                $scope.currentTerrain.photos.splice(index, 1);
                $scope.$apply();
            }
        });
    }

    $scope.afterUpload = function(event, data, previewId, index){
        $(fileinput.input_selector).fileinput('clear');
        $scope.currentTerrain.photos.push(data.response.photo);
        $scope.$apply();
    }

    var initLocation = function(terrain){
        console.log(terrain);
        $timeout(function(){
            console.log('init combo');
            var $select = $('#id_locatie');
            var $option = $("<option selected></option>").val(terrain.localitate.id || 0).text(terrain.localitate.localitate || '');
            $select.html('');
            $select.append($option).trigger('change');
            $select.val(terrain.localitate.id || 0).change();
        },500);
    }

    $scope.edit = function(item){
        $scope.currentTerrain=item;
        initLocation($scope.currentTerrain);
        console.log($scope.currentTerrain.localitate.localitate);
        $scope.EDIT           = true;
        $scope.ADD            = false;
        fileinput.init(item.id, $scope.afterUpload);
        var coords = JSON.parse(item.geometry);
        gmap.clearShapes();
        var polygon= gmap.drawPolygon(coords,item.color_text);
        gmap.setMapCenter( gmap.getPolygonCenter( polygon ) );
        $scope.safe( $scope.init_on_update, item, gmap.activateTab, 3 );
        gmap.disableDrawingControl();
        toastr.info(MESSAGES.EDIT + '<strong><u>' + item.title + '</u></strong>');
        $timeout(initPret,500);
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

$('#suprafata, #pret').on('keyup', initPret);

function initPret(){
    var supraf = parseFloat($('#suprafata').val());
    console.log(supraf);
    var pret = parseFloat($('#pret').val());
    if(supraf > 0 && pret > 0){
        $('#pret_mp').val(pret/supraf);
    }else{
        $('#pret_mp').val('');
    }
}

