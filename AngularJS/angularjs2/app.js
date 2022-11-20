	var app = angular.module('MyApp', []);
    app.controller('MyController', function($scope, $window) {
    
    $scope.redirect = function(){
      
      var url = "/donate/";
      $window.location.href = url;
		
    }
  });