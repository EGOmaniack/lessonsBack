<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 6);
ini_set('xdebug.var_display_max_children', 99);
ini_set('xdebug.var_display_max_data', 1024);

$nick = $_GET["nick"];
$list = $_GET["list"];
$json = file_get_contents('./todo.json');
$todoAll = json_decode($json, true);
$myTodo = [];

for($i = 0; $i < count($todoAll); $i++){
    if(strtolower($todoAll[$i]["NickName"]) == strtolower($nick)){
        if($list == "true"){
            for($j=0; $j<count($todoAll[$i]["todoList"]); $j++){
                $myTodo[] = $todoAll[$i]["todoList"][$j]["label"];
            }
        }else{
            $myTodo = $todoAll[$i]["todoList"];
        }
    }
}

header("Access-Control-Allow-Origin: *");
echo(json_encode($myTodo, JSON_UNESCAPED_UNICODE));
?>