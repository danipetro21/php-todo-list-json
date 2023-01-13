<?php

header("Access-Control-Allow-Origin: http://127.0.0.1:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$newTodo = $_GET['newTodo'];
$index = $_GET['index'];
$completed = $_GET['completed'];

$tasks = json_decode(file_get_contents('todo.json'), true);

if ($completed === "false") {
    $tasks[$index] = [
        "text" => $newTodo,
        "completed" => true
    ];
} else {
    $tasks[$index] = [
        "text" => $newTodo,
        "completed" => false
    ];
}

file_put_contents('todo.json', json_encode($tasks));
