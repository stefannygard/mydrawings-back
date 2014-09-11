// Code goes here
(function() {
  var app = angular.module('demo', ['drawing-gallery-directive', 'ui.bootstrap', 'ngRoute', 'ngSanitize']);
  
  app.config(function($routeProvider, $locationProvider) {
    //$locationProvider.hashPrefix('!');
    $routeProvider.
      when("/logga-in", { templateUrl: "drawapp/partials/logga-in.html" }).
      when("/publikt-galleri", { templateUrl: "drawapp/partials/publikt-galleri.html" }).
      when("/mina-egna", { templateUrl: "drawapp/partials/mina-egna.html" }).
      otherwise( { redirectTo: "/logga-in" });
  });
  

  app.directive('drawing', function() {
    return {
      restrict: "E",
      templateUrl: "drawapp/partials/drawing.html",
      controller:  function($scope) {
        this.hide = true;
        this.index = 0;
        var _this = this;
        
        var initCanvas = function(json) {
          
        }
        
        $scope.$on('showDrawing', function(event,args){
          _this.hide = false;
          _this.index = args.index;
        });
        
      },
      controllerAs: "drawing"
    };
  });
  
  app.directive('9drawingGallery', function() {
    return {
      restrict: 'E',
      templateUrl: 'drawapp/partials/drawing-gallery.html',
      controller: function($scope, $http) {
        var _this = this;
        
        this.showDrawing = function(index) {
          $scope.$broadcast('showDrawing',{index:index})
        }
        
        this.drawings = [];
        $http.get('http://localhost/laravel/public/user/drawings').success(function(data){
          _this.drawings = data.drawings;
        });
        /*
        $scope.$watch('drawingIndex', function() {
          console.log('hey, drawingIndex has changed!',$scope.drawingIndex);
        });
        */
        
      },
      controllerAs: 'gallery'
    };
  });
  
  app.directive('headerMenu', function() {
    return {
      restrict: "E",
      templateUrl: "drawapp/partials/header-menu.html",
      controller: function($location, AuthenticationService) {
        this.collapse = false;
        this.toggle = function() {
          this.collapse = !this.collapse;
        };
        this.isLoggedIn = function() {
          return AuthenticationService.isLoggedIn();          
        };
        this.logOut = function() {
          AuthenticationService.logout();
          $location.path( "/logga-in" );
        };
        this.showLogIn = function() {
          return !this.isLoggedIn() && $location.path().substring(1) != 'logga-in';
        };
        this.menuClass = function(page) {
          var current = $location.path().substring(1);
          return page === current ? "active" : "";
        };
      },
      controllerAs: "header"
    };
  });
  
  app.directive('login', function() {
    return {
      restrict: "E",
      templateUrl: "drawapp/partials/login.html",
      controller: function($location, AuthenticationService) {
        
        this.credentials = {};
        var _this = this;
        
        this.login = function() {
          AuthenticationService.login(_this.credentials).success(    
            function() {
              $location.path('/mina-egna');
            });
        };
      },
      controllerAs: "login"
    };
  });
  
  app.factory("FlashService", function($rootScope) {
    return {
      show: function(message) {
        $rootScope.flash = message;
      },
      clear: function() {
        $rootScope.flash = "";
      }
    }
  });

  app.factory("SessionService", function() {
    return {
      get: function(key) {
        return sessionStorage.getItem(key);
      },
      set: function(key, val) {
        return sessionStorage.setItem(key, val);
      },
      unset: function(key) {
        return sessionStorage.removeItem(key);
      }
    }
  });
    
  app.factory("AuthenticationService", function($http, $sanitize, SessionService, FlashService, CSRF_TOKEN) {

    var cacheSession   = function() {
      SessionService.set('authenticated', true);
    };

    var uncacheSession = function() {
      SessionService.unset('authenticated');
    };

    var loginError = function(response) {
      FlashService.show(response.flash);
    };

    var sanitizeCredentials = function(credentials) {
      return {
        email: $sanitize(credentials.email),
        password: $sanitize(credentials.password),
        csrf_token: CSRF_TOKEN
      };
    };
    
    return {
      login: function(credentials) {
        var login = $http.post("http://localhost/laravel/public/auth/login",
          sanitizeCredentials(credentials));
        login.success(cacheSession);
        login.success(FlashService.clear);
        login.error(loginError);
        return login;
      },
      logout: function() {
        var logout = $http.get("http://localhost/laravel/public/auth/logout");
        logout.success(uncacheSession);
        return logout;
      },
      isLoggedIn: function() {
        return SessionService.get('authenticated');
      }
    };
  });
  
})();