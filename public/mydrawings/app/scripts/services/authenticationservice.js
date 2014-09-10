'use strict';

/**
 * @ngdoc service
 * @name mydrawingsApp.authenticationService
 * @description
 * # authenticationService, 
 * Service in the mydrawingsApp.
 * code from davemo - https://github.com/davemo/end-to-end-with-angularjs
 */
angular.module('mydrawingsApp')
  .service("AuthenticationService", function AuthenticationService ($http, $sanitize, SessionService, FlashService/*, CSRF_TOKEN*/) {

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
      //csrf_token: CSRF_TOKEN
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
