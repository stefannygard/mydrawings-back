'use strict';

/**
 * @ngdoc function
 * @name mydrawingsApp.controller:HeaderCtrl
 * @description
 * # HeaderCtrl
 * Controller of the mydrawingsApp
 */
angular.module('mydrawingsApp')
  .controller('HeaderCtrl', function ($scope, $location, AuthenticationService) {
    this.collapse = false;
    this.toggle = function() {
      this.collapse = !this.collapse;
    };
    this.isLoggedIn = function() {
      return AuthenticationService.isLoggedIn(); 
      return false;
    };
    this.showLogIn = function() {
      return !this.isLoggedIn() && $location.path().substring(1) != 'logga-in';
    };
    this.menuClass = function(page) {
      var current = $location.path().substring(1);
      return page === current ? "active" : "";
    };
  });
