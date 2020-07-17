<?php
require_once __DIR__."/../common.php";

//this is as if a && b else
$protocol=new ProtocolModel\core\defineModel();
$protocol->new_case("myFoo");
$protocol->new_when("myFoo",["foo"=>"bar","foo2"=>"bar2"],"baz");
$protocol->new_else("myFoo","qux");

//this is as if elseif else
$protocol2=new ProtocolModel\core\defineModel();
$protocol2->new_case("myFoo");
$protocol2->new_when("myFoo",["foo"=>"bar"],"baz");
$protocol2->new_when("myFoo",["foo2"=>"bar2"],"baz2");
$protocol2->new_else("myFoo","qux");

$foo="bar";
$foo2="bar2";
echo("prints baz\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");
echo("prints baz\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");

$foo="bar";
$foo2="bar";
echo("prints qux\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");
echo("prints baz\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");


$foo="bar";
echo("prints qux\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");
echo("prints baz\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo])->get());
echo("\n");


$foo="barr";
$foo2="bar2";
echo("prints qux\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");
echo("prints baz2\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2])->get());
echo("\n");
