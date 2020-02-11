<?php
require_once __DIR__.'/../common.php';
$protocol=new ProtocolModel\core\defineModel();
$protocol2=new ProtocolModel\core\defineModel();
$protocol->new_when("myFoo",["foo"=>"bar"],"baz");
$protocol->new_else("myFoo","qux");
$protocol->save_result_to_sess("myFoo",["foo"=>"bar"]);

//prints baz
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");

$protocol->save_result_to_sess("myFoo",["foo"=>"not_bar"]);
//prints qux
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");


$protocol->new_then("myFoo",function($boo){if($boo=="baz"){echo("this is baz\n");}else{echo("this is qux\n");}return("called");});
$protocol->save_result_to_sess("myFoo",["foo"=>"bar"]);
//prints this is baz\ncalled
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");

$protocol->save_result_to_sess("myFoo",["foo"=>"not_bar"]);
//prints this is qux\ncalled
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");


$protocol->new_when("myFoo2",["foo"=>"bar"],"baz");
$protocol->new_else("myFoo2","qux");

$protocol->save_case_to_sess("myFoo2");

$protocol2->load_case_from_sess("myFoo2");

//prints baz
echo($protocol2->case("myFoo2")->when(["foo"=>"bar"]));
echo("\n");

//prints qux
echo($protocol2->case("myFoo2")->when(["foo"=>"not_bar"]));
echo("\n");
