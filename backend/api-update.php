<?php

header("Access-Control-Allow-Origin: http://127.0.0.1:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');


$index = $_GET['index'];

$tasks = json_decode(file_get_contents('todo.json'), true);

$todoElem = $tasks[$index];

$todoElem -> completed = !$todoElem -> completed;

$tasks[$index] = $todoElem;

file_put_contents('todo.json', json_encode($tasks));
