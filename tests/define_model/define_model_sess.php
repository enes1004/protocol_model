<?php
require_once __DIR__.'/../common.php';
$protocol=new ProtocolModel\core\defineModel();
$protocol2=new ProtocolModel\core\defineModel();
$protocol->new_when("myFoo",["foo"=>"bar"],"baz");
$protocol->new_else("myFoo","qux");
$protocol->save_result_to_sess("myFoo",["foo"=>"bar"]);

echo("//prints baz\n");
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");

$protocol->save_result_to_sess("myFoo",["foo"=>"not_bar"]);
echo("//prints qux\n");
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");


$protocol->new_then("myFoo",function($boo){if($boo=="baz"){echo("this is baz\n");}else{echo("this is qux\n");}return("called");});
$protocol->save_result_to_sess("myFoo",["foo"=>"bar"]);
echo("//prints this is baz\ncalled\n");
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");

$protocol->save_result_to_sess("myFoo",["foo"=>"not_bar"]);
echo("//prints this is qux\ncalled\n");
echo($protocol2->load_result_from_sess("myFoo"));
echo("\n");


$protocol->new_when("myFoo2",["foo"=>"bar"],"baz");
$protocol->new_else("myFoo2","qux");

$protocol->save_case_to_sess("myFoo2");

$protocol2->load_case_from_sess("myFoo2");

echo("//prints baz\n");
echo($protocol2->case("myFoo2")->when(["foo"=>"bar"])->get());
echo("\n");

echo("//prints qux\n");
echo($protocol2->case("myFoo2")->when(["foo"=>"not_bar"])->get());
echo("\n");
