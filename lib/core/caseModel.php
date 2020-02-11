<?php
namespace ProtocolModel\core;
class caseModel{
  public function __construct(){
    $this->conds=[];
    $this->else=false;
    $this->then_internal=function($a){return($a);};
  }
  public function new_when($conds,$out){
    $this->conds[]=["conds"=>$conds,"out"=>$out];
  }
  public function new_else($out){
    $this->else=$out;
  }

  public function new_then($callback=false){
    $callback=!empty($callback)?$callback:function($a){return($a);};
    $this->then_internal=$callback->bindTo($this);
  }
  public function then($a){
    return($this->then_internal->call($this,$a));
  }
  public function when($inputs=[]){
    foreach ($this->conds as $cond) {
      $should_out=true;
      foreach ($cond["conds"] as $key => $value) {
      if(isset($inputs[$key])){
        if($inputs[$key]!=$value){$should_out=false;}
      } else{$should_out=false;}
      }
      if($should_out){return($this->then($cond["out"]));}
    }
    return($this->then($this->else));
  }
  public function parse_to_save(){
    $conds=$this->conds;
    $conds["else"]=$this->else;
    return($conds);
  }
  public function load_from_save($save){
    $this->else=!empty($save["else"])?$save["else"]:false;
    $this->conds=array_diff_key($save,["else"=>""]);

  }

}
