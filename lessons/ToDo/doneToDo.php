<?php
ini_set('display_errors', 0) ;
$nick = $_POST['nick'];
$input = $_POST['input']; //id
$list = $_POST['list'];

$file_name = './todo.json';
$json = file_get_contents($file_name);
$todoAll = json_decode($json, true);
$myTodo = [];
for($i = 0; $i < count($todoAll); $i++){
    if($todoAll[$i]["NickName"] == $nick){

        for($j=0; $j<count($todoAll[$i]["todoList"]); $j++){
            if($todoAll[$i]["todoList"][$j]["id"] == $input){
                if($todoAll[$i]["todoList"][$j]['done'] == false){
                    $todoAll[$i]["todoList"][$j]['done'] = true;
                } else {
                    $todoAll[$i]["todoList"][$j]['done'] = false;
                }
            }
        }
        
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
    json_encode($todoAll,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

header("Access-Control-Allow-Origin: *");
echo(json_encode($myTodo, JSON_UNESCAPED_UNICODE));
?>