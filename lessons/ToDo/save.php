<?php
$nick = $_POST['nick'];
$newarr = $_POST['input'];
$list = false;
if(isset($_POST['input'])){
    $list = $_POST['list'];
}

$savedItems = json_decode($newarr, true);

$file_name = './todo.json';
$json = file_get_contents($file_name);
$count = intval(file_get_contents('./count'));
$newItems = [];
//добавить в массив поля id и done
if($list == 'true'){
    for($i=0;$i<count($savedItems);$i++){
        $newItems[] = array('id'=>$count, 'label'=>$savedItems[$i], 'done'=>false );
        $count++;
    }
} else {
    for($i=0;$i<count($savedItems);$i++){
        $newItems[] = array('id'=>$count, 'label'=>$savedItems[$i]["label"], 'done'=>$savedItems[$i]["done"] );
        $count++;
    }
}

$todoAll = json_decode($json, true);
$myTodo;
for($i = 0; $i < count($todoAll); $i++){
    if(strtolower($todoAll[$i]["NickName"]) == strtolower($nick)){
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