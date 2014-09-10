'use strict';

/**
 * @ngdoc overview
 * @name mydrawingsApp
 * @description
 * # mydrawingsApp
 *
 * Main module of the application.
 */
var app = angular
  .module('mydrawingsApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ui.bootstrap'
  ])
  .config(function ($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/studio', {
        templateUrl: 'views/studio.html',
        controller: 'StudioCtrl'
      })
      .when('/galleri', {
        templateUrl: 'views/galleri.html',
        controller: 'GalleriCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
