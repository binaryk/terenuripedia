app.controller('PayCtrl',['$scope','$http','$rootScope','$compile','$timeout','$sce', function PayCtrl($scope, $http, $rootScope, $compile, $timeout,$sce){
  $scope.subscriptions;
  $scope.range;
  $scope.percents;
  $scope.description = '';
  $scope.last_variable = '';
  $scope.form          = {};
  $scope.form.nr_plans = 1;
  $scope.view_info     = false;
  $.get($rootScope.config.get_subscriptions, function(data){
    $scope.subscriptions = data;
    console.log(data);
  });
  $scope.updatePercent = function(el){
    console.log(el);
    $scope.last_variable = "procent=" + el;
  }

  $scope.updatePer = function(el){
    console.log(el);
    $scope.last_variable = "per=" + el;
  }

  $scope.updateInfo = function(subscription){
    console.log($scope.subscriptions[subscription-1]);
    console.log(subscription);
    
    $scope.description = $sce.trustAsHtml($scope.subscriptions[subscription-1].descriptions);
    console.log($scope.description);
  }

  $scope.range = $.map($rootScope.config.per, function(value, index) {
    var obj = {};
    obj['name'] = value;
    obj['id'] = index;
    return [
      obj
    ];
  });

  $scope.percents = $.map($rootScope.config.percents, function(value, index) {
    var obj = {};
    obj['name'] = value;
    obj['id'] = index;
    return [
      obj
    ];
  });

  $scope.show = function(){
    console.log($scope.view_info);
    $scope.view_info = ! $scope.view_info
  }
  
}]);