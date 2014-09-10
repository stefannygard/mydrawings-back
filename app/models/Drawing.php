<?php

class Drawing extends Eloquent{
  protected $guarded = array();
  
  public function drawingObjects()
  {
    return $this->hasMany('DrawingObject');
  }
  
  public function user()
  {
    return $this->belongsTo('User');
  }

}