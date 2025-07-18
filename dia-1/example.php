<?php

$tasks = [];

$newTask = readline("Add a new task:");

$tasks[] = $newTask;

echo "\n📋 Task list: \n";

foreach($tasks as $index => $task){
    echo ($index + 1) . ". " . $task . "\n";
}

