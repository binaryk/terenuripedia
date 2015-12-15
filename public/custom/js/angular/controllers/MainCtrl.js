app.controller(
            'MainCtrl', ['$scope', '$http', '$rootScope', '$compile', '$timeout','$http','uiGmapGoogleMapApi',
    function MainCtrl($scope, $http, $rootScope, $compile, $timeout, uiGmapGoogleMapApi) {
        console.log('MainCtrl');

      

   $scope.locationsFiltered = [{
      id: 5,
      latitude: 44.4284821,
      longitude: 26.1241451,
      title: 'test1'
        }, 
        {
          id: 4,
          latitude: 43,
          longitude: 26.1241451,
          title: 'test2' 
        }

    ];

  $scope.map = {
    center: {
      latitude: 44,
      longitude: 26
    },
    control: {

    },
    zoom:   8,
    bounds: {},
    markers: {
      models: $scope.locationsFiltered,
      type: 'cluster',
      typeOptions: {
        minimumClusterSize: 12,
        gridSize: 60
      }
    },
    templatedInfoWindow: {
      show: true,
      options: {},
      templateUrl: 'templates/maps/windowContent.html',
      templateParameter: { locations: $scope.locationsFiltered },
      marker: {},
      closeClick: function() {
        this.show = false;
      },
      coords: {
        }
    },
    markersEvents: {
      click: function(marker, eventName, model) {
        $scope.map.templatedInfoWindow.model = model;
        $scope.map.templatedInfoWindow.coords = { latitude: model.latitude, longitude: model.longitude};
        console.log(model);
        $scope.map.templatedInfoWindow.marker = {
          id: model.id,
          coords: {
            latitude: model.latitude,
            longitude: model.longitude
          },
          title: model.title
        };
        $scope.map.templatedInfoWindow.show = true;
        $scope.map.center = {
          latitude: model.latitude,
          longitude: model.longitude
        };
      }
    },
    window: {
      marker: {},
      show: true,
      closeClick: function() {
        this.show = false;
      },
      options: {
        maxWidth: 300
      }
    },
    options: {
 /*     mapTypeControl: false,
      zoomControl: false,
      streetViewControl: false,
      scrollwheel: false*/
    },
     drawingManagerOptions: {

            drawingMode: null,
            drawingControl: false,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    google.maps.drawing.OverlayType.CIRCLE,
                    google.maps.drawing.OverlayType.POLYGON,
                    google.maps.drawing.OverlayType.POLYLINE,
                    google.maps.drawing.OverlayType.RECTANGLE
                ]
            },
            rectangleOptions: this.polyOptions,
            polygonOptions: this.polyOptions,
            circleOptions: this.polyOptions
        },
        markersAndCircleFlag: true,
        drawingManagerControl: {}
  }; 

  $scope.$watch('map.drawingManagerControl.getDrawingManager', function (val) {
       if (!$scope.map.drawingManagerControl.getDrawingManager) {
           return;
       }

       google.maps.event.addListener($scope.map.drawingManagerControl.getDrawingManager(), 'circlecomplete', function (e) {
           console.log(e);
       });

   });






}]); 

