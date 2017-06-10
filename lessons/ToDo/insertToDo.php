<?php
$nick = $_POST['nick'];
$input = $_POST['input'];
$list = $_POST['list'];

$newItem = array('lable'=>$input, 'done'=>false);
$file_name = './todo.json';
$json = file_get_contents($file_name);
$todoAll = json_decode($json, true);
$myTodo;
for($i = 0; $i < count($todoAll); $i++){
    if($todoAll[$i]["NickName"] == $nick){
        $todoAll[$i]["todoList"][] = $newItem;
        if($list == "true"){
            for($j=0; $j<count($todoAll[$i]["todoList"]); $j++){
                $myTodo[] = $todoAll[$i]["todoList"][$j]["lable"];
            }
        }else{
            $myTodo = $todoAll[$i]["todoList"];
        }
    }
}
file_put_contents(
    $file_name,
    json_encode($todoAll, JSON_UNESCAPED_UNICODE)
);
header("Access-Control-Allow-Origin: *");
echo(json_encode($myTodo, JSON_UNESCAPED_UNICODE));
?>