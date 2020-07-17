<?php
namespace ProtocolModel\core;
use \ProtocolModel\core\caseModel;
//model for defining protocol to execute
class defineModel{
  public function __construct(){
    $this->protocols=[];
  }
  public function new_case($case_name,$params=[]){
    $this->protocols[$case_name]=new caseModel();
    }
  public function case($case_name){
    return($this->protocols[$case_name]);
  }
  public function new_when($case_name,$cond,$out){
    if(!isset($this->protocols[$case_name])){$this->new_case($case_name);}
    $this->protocols[$case_name]->new_when($cond,$out);
  }
  public function new_then($case_name,$callback){
    if(!isset($this->protocols[$case_name])){$this->new_case($case_name);}
    $this->protocols[$case_name]->new_then($callback);
  }

  public function new_else($case_name,$out){
    if(!isset($this->protocols[$case_name])){$this->new_case($case_name);}
    $this->protocols[$case_name]->new_else($out);
  }

  private function save_to_sess($case_name,$to_sess,$type){
    if(!isset($_SESSION)){session_start();}
    if(!isset($_SESSION["protocol_mem"])){$_SESSION["protocol_mem"]=[$type=>[]];}
    $_SESSION["protocol_mem"][$type][$case_name]=$to_sess;
  }
  private function load_from_sess($case_name,$type){
    if(!isset($_SESSION)){session_start();}
    return($_SESSION["protocol_mem"][$type][$case_name]);

  }
  public function save_result_to_sess($case_name,$cond){
    $to_sess=$this->protocols[$case_name]->when($cond)->get();
    $this->save_to_sess($case_name,$to_sess,"results");
  }
  public function load_result_from_sess($case_name){
    return($this->load_from_sess($case_name,"results"));
  }

  public function save_case_to_sess($case_name){
    $to_sess=$this->protocols[$case_name]->parse_to_save();
    $this->save_to_sess($case_name,$to_sess,"cases");
  }
  public function load_case_from_sess($case_name){
    $conds=$this->load_from_sess($case_name,"cases");
    $this->new_case($case_name);
    $this->case($case_name)->load_from_save($conds);
  }

}
