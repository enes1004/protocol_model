<pre>
<?php
require_once __DIR__."/../common.php";
//this is as if a && b else
$protocol=new ProtocolModel\core\defineModel();
$protocol->new_case("myFoo");
$protocol->new_when("myFoo",["foo"=>"bar","foo2"=>"bar2"],"baz");
$protocol->new_else("myFoo","qux");

//this is as if a else. never prints qux
$protocol2=new ProtocolModel\core\defineModel();
$protocol2->new_case("myFoo");
$protocol2->new_when("myFoo",["foo"=>"bar"],"baz");
$protocol2->new_when("myFoo",[],"baz2");
$protocol2->new_else("myFoo","qux");

//this is as return(a) for all inputs
$protocol3=new ProtocolModel\core\defineModel();
$protocol3->new_case("myFoo");
$protocol3->new_when("myFoo",[],"baz3");
$protocol3->new_else("myFoo","qux");

//empty protocols
$foo="bar";
$foo2="bar2";
echo("prints baz\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("prints baz\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("prints baz3\n");
echo($protocol3->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("\n");

//empty protocol after not matched input
$foo="barr";
$foo2="bar2";
echo("prints qux\n");
echo($protocol->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("prints baz2\n");
echo($protocol2->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("prints baz3\n");
echo($protocol3->case("myFoo")->when(["foo"=>$foo,"foo2"=>$foo2]));
echo("\n");
echo("\n");


//empty inputs
$foo="bar";
$foo2="bar";
echo("prints qux\n");
echo($protocol->case("myFoo")->when());
echo("\n");
echo("prints baz2\n");
echo($protocol2->case("myFoo")->when());
echo("\n");
echo("prints baz3\n");
echo($protocol3->case("myFoo")->when());
echo("\n");
