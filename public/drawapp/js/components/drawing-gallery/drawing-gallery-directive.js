(function() {
  var app = angular.module('drawing-gallery-directive', ['ui.bootstrap', 'ngRoute', 'ngSanitize']);
    
  app.directive('drawingGallery', function() {
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
})();