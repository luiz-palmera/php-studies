<?php

$tasks = [];

echo("✨Please add 3 tasks✨ \n \n");

$counter = 1;

while($counter <= 3){
    $tasks[]= readline("  -Task $counter: ");
    $counter++;
}

echo "\n📋 Task List: \n";

foreach($tasks as $index => $task){
    echo ($index + 1) . ". " . $task . "\n";
}