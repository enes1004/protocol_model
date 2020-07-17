Models for writing conditions as "named protocols"

<!-- Still abstract -->


Example

```
function($foo){

if($foo=="bar"){

  return("baz");

}

else{

  return("qux");

}

}
```


becomes

```
$protocol=new defineModel();

$protocol->new_case("myFoo");

$protocol->new_when("myFoo",["foo"=>"bar"],"baz");

$protocol->new_else("myFoo","qux");

$foo="bar";

//prints "baz"

echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());

$foo="not_bar";

//prints "qux"

echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());
```

can also pass callback with new_then (default is function($a){return($a)}. if passed empty input, it resets)

```
$protocol->new_then("myFoo",function($boo){if($boo=="baz"){echo("this is baz\n");}else{echo("this is qux\n");}return("called");});


$foo="bar";

//prints "this is baz\ncalled"

echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());


$foo="not_bar";

//prints "this is qux\ncalled"

echo($protocol->case("myFoo")->when(["foo"=>$foo])->get());

```

//new case declaration can be omitted

```
$protocol->new_when("myFoo",["foo"=>"bar"],"baz");

$protocol->new_else("myFoo","qux");
```

is equivalent to this

```
$protocol->new_case("myFoo");

$protocol->new_when("myFoo",["foo"=>"bar"],"baz");

$protocol->new_else("myFoo","qux");
```
