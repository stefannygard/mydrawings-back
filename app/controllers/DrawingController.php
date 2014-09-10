<?php

class DrawingController extends \BaseController {

  public function __construct()
  {
      //$this->beforeFilter('serviceAuth');
      //$this->beforeFilter('serviceCSRF');
      
      $this->beforeFilter('editDrawing', array('only'=>array('postSave','postRemove')));
      $this->beforeFilter('auth', array('only'=>array('postCreate')));
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
    $drawings = Drawing::All();
    return Response::json([
        'drawings' => $drawings->toArray()
    ]);
	}
  
  public function postSave($id)
	{
    $drawingObjectsData = Input::get('drawing_objects');
    
    DrawingObject::where("drawing_id", $id)->delete();
    
    for($c=0,$l=sizeof($drawingObjectsData);$c<$l;$c++) {
      // simple sanity fix if drawing_id has been manually changed
      $drawingObjectsData[$c]['drawing_id'] = $id;
      DrawingObject::create($drawingObjectsData[$c]);
    }
   
    $drawing = Drawing::find($id)->update(array('name'=>Input::get('name'),'img_thumb'=>Input::get('img_thumb')));
    
    return Response::json(array('flash' => 'Sparat!'));
	}
  public function postRemove($id)
  {
    DrawingObject::where("drawing_id", $id)->delete();
    Drawing::find($id)->delete();
    return Response::json(array('flash' => 'Borttagen!'));
  }
  public function postCreate()
  {
    $drawing = Drawing::create(array(
        'user_id' => Auth::user()->id,
        'original_user_id' => Auth::user()->id,
        'img_thumb' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPIAAADICAIAAABd6ys4AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjNCNTY3MTkzOEJEMTFFNEE2NkNFQTA4RUJGNTlGNzgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjNCNTY3MUEzOEJEMTFFNEE2NkNFQTA4RUJGNTlGNzgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2M0I1NjcxNzM4QkQxMUU0QTY2Q0VBMDhFQkY1OUY3OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2M0I1NjcxODM4QkQxMUU0QTY2Q0VBMDhFQkY1OUY3OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PvH6ANcAAAGPSURBVHja7NIBDQAACMMw7l/00QFpJSxL24FfYmtsDbYGW4OtwdbYGmwNtgZbg62xta2xNdgabA22Bltja7A12BpsDbbG1rbG1mBrsDXYGmyNrcHWYGuwNdgaW6uArcHWYGuwNdgaW4OtwdZga7A1tgZbg63B1mBrsDW2BluDrcHWYGtsDbYGW4OtwdZga2wNtgZbg63B1tgabA22BluDrcHW2BpsDbYGW4OtsTXYGmwNtgZbg62xNdgabA22Bltja7A12BpsDbYGW2NrsDXYGmwNtsbWYGuwNdgabA22xtZga7A12Bpsja3B1mBrsDXYGmyNrcHWYGuwNdgaW4OtwdZga7A12Bpbg63B1mBrsDW2BluDrcHWYGuwNbYGW4OtwdZga2wNtgZbg63B1mBrbA22BluDrcHW2BpsDbYGW4OtwdbYGmwNtgZbg62xNdgabA22BluDrbE12BpsDbYGW2NrsDXYGmwNtgZbY2uwNdgabA22xtZga7A12BpsDbbG1mBrsDXYGmyNreG6FWAASK9Wj0+Ho6AAAAAASUVORK5CYII=',
        'name' => 'Bild',
    ));
    return Response::json(array('id' => $drawing->id, 'flash'=>'Skapad!'));
  }
  
  public function getDrawing($id)
  {
    $drawing = Drawing::with('drawingObjects')->where('id',$id)->get();
    return Response::json($drawing->toArray());
  }
  
}