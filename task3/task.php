<?php

class Task{

  public $description1;
  public $title;
  public $completed;
  
  public function __construct($description2, $title){
  	$this->description1 = $description2;
  	$this->title = $title;

  	  }

  	  public function complete(){
  	  	$this->completed = true;
  	  }


}
 $task = new Task('learn OOP', 'OOP bootcamp course');
 var_dump($task->description1);
 var_dump($task->title);

 $task->complete();
 var_dump($task->completed);


?>