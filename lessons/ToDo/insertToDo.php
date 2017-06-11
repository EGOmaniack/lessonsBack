<?php
$nick = $_POST['nick'];
$input = $_POST['input'];
$list = $_POST['list'];

$newItem = array('label'=>$input, 'done'=>false);
$file_name = './todo.json';
$json = file_get_contents($file_name);
$count = intval(file_get_contents('./count'));
$newItem["id"] = $count;

$todoAll = json_decode($json, true);
$myTodo;
for($i = 0; $i < count($todoAll); $i++){
    if($todoAll[$i]["NickName"] == $nick){
        $todoAll[$i]["todoList"][] = $newItem;
        if($list == "true"){
            for($j=0; $j<count($todoAll[$i]["todoList"]); $j++){
                $myTodo[] = $todoAll[$i]["todoList"][$j]["label"];
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
$count++;
file_put_contents(
    './count',
    $count
);
header("Access-Control-Allow-Origin: *");
echo(json_encode($myTodo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>