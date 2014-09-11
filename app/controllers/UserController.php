<?php

class UserController extends \BaseController {
  
  public function __construct()
  {
      $this->beforeFilter('auth', array('only'=>array('getDrawings')));
  }
  
	public function getIndex() { 
    //
  }
  
  public function getDrawings() {
    $drawings = Auth::user()->drawings;
    
    return Response::json([
      'drawings' => $drawings//->toArray()
    ]);
  }
}
