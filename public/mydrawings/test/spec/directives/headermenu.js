'use strict';

describe('Directive: headermenu', function () {

  // load the directive's module
  beforeEach(module('mydrawingsApp'));

  var element,
    scope;

  beforeEach(inject(function ($rootScope) {
    scope = $rootScope.$new();
  }));

  it('should make hidden element visible', inject(function ($compile) {
    element = angular.element('<headermenu></headermenu>');
    element = $compile(element)(scope);
    expect(element.text()).toBe('this is the headermenu directive');
  }));
});
