<?php

$tasks = [];

$running = true;

$counter = 0;

function getUserInputs(string $message){
    return readline($message);
}

function showMenu() {
    echo "\n📋 Task manager\n";
    echo "\n[1] Add task \n[2] Task List \n[3] Mark as completed \n[4] Completed Tasks \n[5] Clear Screen \n[0] Exit\n";
    $selectedOption = getUserInputs("\nChoose one option: ");
    return $selectedOption;
}

function addTask(&$taskId, &$tasks) {
    $newTask = getUserInputs("\nType your task: ");
    foreach($tasks as $index => $task){
        if($task['name'] == $newTask){
            echo "\n ⚠️ This task already exists! \n";
            return;
        }
    }

    $tasks[$taskId] = [
        'id' => ($taskId + 1),
        'name' => $newTask,
        'done' => false, 
    ];
    $taskId++;
}

function listTasks($tasks) {
    if (empty($tasks)) {
        echo "🔸 No tasks added yet.\n";
        return;
    }

    foreach($tasks as $index => $task){
        $completed = $task['done'] ? '✅' : '⬜';
        echo "$completed " . ($index + 1) . ". " . $task['name'] . "\n";
    }
}

function completeTask(&$tasks) {
    $completedTask = (int)getUserInputs("Which task do you wanna complete? ");
    $taskIndex = $completedTask - 1;

    if (isset($tasks[$taskIndex])) {
        $tasks[$taskIndex]['done'] = true;
    } else {
        echo "\n⚠️ Invalid task number.\n";
    }

    if($tasks[$taskIndex]['done'] === true){
        echo "\n⚠️ This task is already completed.\n";
        return;
    }
}

function listCompletedTasks($tasks){
    echo "\nYour completed tasks:\n";
    foreach($tasks as $index => $task){
        if($task['done']){
            echo "✅ " . ($index + 1) . ". " . $task['name'] . "\n";
        }
    }
}

function shutDown() {
    echo "\nShutting down...";
    return false;
}

while($running){

    $option = showMenu();

    switch($option){
        case '1': 
            addTask($counter, $tasks);
            break;

        case '2':
            listTasks($tasks);
            break;

        case '3':
            completeTask($tasks);
            break;
            
        case '4':
            listCompletedTasks($tasks);
            break;
        
        case '0':
            $running = shutDown();
            break;

        default:
            echo "\n❌ Invalid option. Try again.\n";
    }
}