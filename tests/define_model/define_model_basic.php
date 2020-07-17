<?php
require_once __DIR__."/../common.php";

$protocol=new ProtocolModel\core\defineModel();
$protocol->new_case("myFoo");
$protocol->new_when("myFoo",["foo"=>"bar"],"baz");
$protocol->new_else("myFoo","qux");

$foo="bar";
//prints "baz"
echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");

$foo="barr";
//prints "qux"
echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");
echo("\n");

//if callback passed to new_then, it calls callback with result as input, instead of return
$protocol->new_then("myFoo",function($boo){if($boo=="baz"){echo("this is baz\n");}else{echo("this is qux\n");}return("called");});

$foo="bar";
//prints "this is baz\ncalled"
echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");

$foo="not_bar";
//prints "this is qux\ncalled"
echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");
