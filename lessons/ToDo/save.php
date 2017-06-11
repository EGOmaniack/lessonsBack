<?php
$nick = $_POST['nick'];
$newarr = $_POST['input'];
$list = $_POST['list'];

$savedItems = json_decode($newarr, true);

$file_name = './todo.json';
$json = file_get_contents($file_name);
$count = intval(file_get_contents('./count'));
$savedItems["id"] = $count;
$newItems = [];
//добавить в массив поля id и done
if($list == 'true'){
    for($i=0;$i<count($savedItems)-1;$i++){
        $newItems[] = array('id'=>$count, 'label'=>$savedItems[$i], 'done'=>false );
        $count++;
    }
}

$todoAll = json_decode($json, true);
$myTodo;
for($i = 0; $i < count($todoAll); $i++){
    if($todoAll[$i]["NickName"] == $nick){
        unset($todoAll[$i]["todoList"]);
        $todoAll[$i]["todoList"] = $newItems;
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