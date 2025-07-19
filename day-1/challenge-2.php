<?php

$tasks = [];

echo("✨Add your tasks✨ \n \n");

$counter = 0;

while($counter < 3){
    $newTask = readline("  -Task " . ($counter + 1) . ": ");
    $tasks[$counter] = [ "name" => $newTask, "done" => false  ];
    $counter++;
}

$completedTask = readline("\n Wich task do you have completed? (1-3): ");

echo "\n📋 Task List: \n";

foreach($tasks as $index => $task){
    $completed = '⬜';

    if (($index + 1) == $completedTask){
        $completed = '✅';
    };

    echo "$completed " . ($index + 1) . "." . $task['name'] . "\n";
}

