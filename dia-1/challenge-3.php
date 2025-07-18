<?php

$tasks = [];


echo("✨Add your tasks✨ \n \n");

$counter = 0;

while(true){
    $newTask = readline("Add a task (or type 'exit' to leave): ");
    if($newTask === "exit"){
        break;
    }
    $tasks[$counter] = [ "name" => $newTask, "done" => false  ];
    $counter++;
}

echo "\n📋 Initial Tasks: \n";

foreach($tasks as $index => $task){
    echo ($index + 1) . "." . $task['name'] . "\n";
}

$removeTask= readline("\n Wich task do you want to remove?  ");

echo "\n📋 Current Tasks: \n";

unset($tasks[$removeTask -1]);

$tasks = array_values($tasks);

foreach($tasks as $index => $task){
        echo ($index + 1) . ". " . $task['name'] . "\n";
}





