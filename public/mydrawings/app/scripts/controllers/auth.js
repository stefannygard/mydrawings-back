'use strict';

/**
 * @ngdoc function
 * @name mydrawingsApp.controller:AuthCtrl
 * @description
 * # AuthCtrl
 * Controller of the mydrawingsApp
 */
angular.module('mydrawingsApp')
  .controller('AuthCtrl', function ($scope, $location, AuthenticationService) {
    this.credentials = {};
    var _this = this;
    
    this.submit = function () {
      AuthenticationService.login(_this.credentials).success(    
        function() {
          $location.path('/galleri');
      });
    }
});
