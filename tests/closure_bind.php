<?php
class A{
  public function __construct(){$this->then=function($a){return($a);};}
  public function use_then($a){
    return($this->then->call($this,$a));
  }
  public function new_then($callback){
    $this->then=$callback->bindTo($this);
  }
}

$then=function($a){return("not only ".$a);};
$obj=new A();
var_dump($obj->use_then("a"));
$obj->new_then($then);
var_dump($obj->use_then("a"));
var_dump($obj);
