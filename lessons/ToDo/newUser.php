<?php
ini_set('display_errors', 0);
ini_set('xdebug.var_display_max_depth', 6);
ini_set('xdebug.var_display_max_children', 99);
ini_set('xdebug.var_display_max_data', 1024);

$nick = $_GET['nick'];
$name = $_GET['name'];
$codeFraze = $_GET['code'];

function CreateItem($title, $plus, $count) {
    $arr = [];
    $arr['id'] = $count + $plus;
    $arr['label'] = $title;
    $arr['done'] = false;

    return $arr;
}

if( $nick && $name && $codeFraze === 'мартышлюшка' ){

    $count = intval(file_get_contents('./count'));

    $json = file_get_contents('./todo.json');
    $theList = json_decode($json, true);

    $newUser = [];
    $newUser['NickName'] = $nick;
    $newUser['name'] = $name;
    $newUser['todoList']= array(0 => CreateItem('Сделать заготовку под ToDo', 1, $count),
        1 => CreateItem('Отрисовка из переменной', 2, $count),
        2 => CreateItem('Реализовать добавление', 3, $count),
        3 => CreateItem('Реализовать удаление', 4, $count),
        4 => CreateItem('Рефакторинг', 5, $count),
        5 => CreateItem('Прикрутить бэк енд', 6, $count),
        6 => CreateItem('Profit!', 7, $count)
    );

    $theList[] = $newUser;
    $content = json_encode($theList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(
        './todo.json',
        $content
    );
    $count += 10;
    file_put_contents(
        './count',
        $count
    );
    // var_dump($theList);
} else {
    echo 'Необхожимо ввести nick, name и кодовую фразу(code)';
}
?>