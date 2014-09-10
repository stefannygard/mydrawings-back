<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DrawApp</title>
    
    <link rel="stylesheet" type="text/css" href="drawapp/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="drawapp/css/app.css" />
</head>
<body ng-app="demo">

  <header-menu></header-menu>
  
  <div class="alert alert-danger" role="alert" ng-show="flash" ng-bind="flash">{{ flash }}</div>
  
  <ng-view></ng-view>

<script type="text/javascript" src="drawapp/lib/angular/angular.min.js"></script>
<script type="text/javascript" src="drawapp/lib/angular/angular-route.min.js"></script>
<script type="text/javascript" src="drawapp/lib/angular/angular-sanitize.js"></script>
<script type="text/javascript" src="drawapp/lib/angular/ui-bootstrap-tpls-0.11.0.min.js"></script>
<script type="text/javascript" src="drawapp/js/app.js"></script>
<script type="text/javascript" src="drawapp/js/components/drawing-gallery/drawing-gallery-directive.js"></script>



<script>
angular.module("demo").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>'); 
</script>
</body>
</html>