<?php

class DrawingObjectsTableSeeder extends Seeder {
    public function run(){
      DB::table('drawing_objects')->delete();
           
      DrawingObject::create(array(
          'drawing_id' => 1,
          'amplitudeX' => 120,
          'amplitudeY' => 100,
          'time' => 0,
          'shape' => 'star',
          'color' => '#ff00ff'
      ));
      
      DrawingObject::create(array(
          'drawing_id' => 1,
          'amplitudeX' => 110,
          'amplitudeY' => 340,
          'time' => 0,
          'shape' => 'rectangle',
          'color' => '#ff00ff'
      ));
      
    }
}