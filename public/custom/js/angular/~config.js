var app = angular.module('app', [])
/*.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('{[');
  $interpolateProvider.endSymbol(']}');
})*/
.run(function($rootScope){
  $rootScope.config = _config;
})