<?php

class UserController extends \BaseController {

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
