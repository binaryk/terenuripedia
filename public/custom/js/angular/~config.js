var app = angular.module('app', ['ui-rangeSlider'])
/*.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('{[');
  $interpolateProvider.endSymbol(']}');
})*/
.run(function($rootScope){
  $rootScope.config = _config;
})