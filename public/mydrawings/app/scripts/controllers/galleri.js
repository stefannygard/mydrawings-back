'use strict';

/**
 * @ngdoc function
 * @name mydrawingsApp.controller:GalleriCtrl
 * @description
 * # GalleriCtrl
 * Controller of the mydrawingsApp
 */
angular.module('mydrawingsApp')
  .controller('GalleriCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
