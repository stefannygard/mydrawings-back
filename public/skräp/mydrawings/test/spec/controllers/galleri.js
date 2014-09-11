'use strict';

describe('Controller: GalleriCtrl', function () {

  // load the controller's module
  beforeEach(module('mydrawingsApp'));

  var GalleriCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    GalleriCtrl = $controller('GalleriCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
