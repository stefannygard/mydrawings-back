<?php

class DrawingObject extends Eloquent{
  protected $guarded = array();
  
  public function drawing()
  {
    return $this->belongsTo('Drawing');
  }

}