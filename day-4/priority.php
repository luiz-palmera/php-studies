<?php

$tasks = [];

$running = true;

$counter = 0;

function getUserInputs(string $message){
    return readline($message);
}

function showMenu() {
    echo "\n📋 Task manager\n";
    echo "\n[1] Add task \n[2] Task List \n[3] Mark as completed \n[4] Completed Tasks \n[5] Delete Task \n[0] Exit\n";
    $selectedOption = getUserInputs("\nChoose one option: ");
    return $selectedOption;
}

function addTask(&$taskId, &$tasks) {
    $newTask = getUserInputs("\nType your task: ");
    foreach($tasks as $index => $task){
        if($task['name'] == $newTask){
            echo "\n ⚠️  - This task already exists! \n";
            return;
        }
    }
    
    $priority = 0; 

    $choosingPriority = true;


    while($choosingPriority){
        $taskPriority = getUserInputs(" \nTask priority(high, medium or low): ");
        switch(strtolower($taskPriority)){
            case "high":
                $priority = 1;
                $choosingPriority = false;
                break;

            case "medium":
                $priority = 2;
                $choosingPriority = false;
                break;

            
            case "low":
                $priority = 3;
                $choosingPriority = false;
                break;
                
            default:
                echo "\n  ⚠️  - Please type a valid priority. \n";
        }
    }


    $tasks[$taskId] = [
        'id' => ($taskId + 1),
        'name' => $newTask,
        'done' => false, 
        'priority' => $priority
    ];
    $taskId++;
}

function listTasks($tasks) {
    if (empty($tasks)) {
        echo "🔸 No tasks added yet.\n";
        return;
    }

    $prio = '';

    $prioCounter = [
        'high' => 0,
        'medium' => 0,
        'low' => 0
    ];

    usort($tasks, function($a, $b) {
        return $a['priority'] <=> $b['priority'];
    });

    echo"--------------------- 📋Task List --------------------\n \n";
    foreach($tasks as $index => $task){
        if($task['priority'] == 1){
            $prio = 'high';
            $prioCounter[$prio]++;
        } elseif($task['priority'] == 2){
            $prio = 'medium';
            $prioCounter[$prio]++;
        } else {
            $prio = 'low';
            $prioCounter[$prio]++;
        }
        $completed = $task['done'] ? '✅' : '⬜';
        echo "$completed " . ($index + 1) . ". " . $task['name'] . " (Priority: " . $prio .")\n";        
    }
    echo"\n------------------------------------------------------\n";
    echo"Tasks per priority: 🟥 High:" . $prioCounter['high'] . " | 🟧 Medium:" . $prioCounter['medium'] . " | 🟨 Low:" . $prioCounter['low'] . "\n";
}

function completeTask(&$tasks) {
    $completedTask = (int)getUserInputs("Which task do you wanna complete? ");
    $taskIndex = $completedTask - 1;

    if($tasks[$taskIndex]['done'] === true){
        echo "\n⚠️  - This task is already completed.\n";
        return;
    }

    if (isset($tasks[$taskIndex])) {
        $tasks[$taskIndex]['done'] = true;
    } else {
        echo "\n⚠️  - Invalid task number.\n";
    }
}

function listCompletedTasks($tasks){
    echo "\nYour completed tasks:\n";

    if (empty($tasks)) {
        echo "🔸 No tasks added yet.\n";
        return;
    }

    $prio = '';

    $prioCounter = [
        'high' => 0,
        'medium' => 0,
        'low' => 0
    ];

    usort($tasks, function($a, $b) {
        return $a['priority'] <=> $b['priority'];
    });

    echo"------------------ 🟢 Completed Tasks ------------------\n";
    foreach($tasks as $index => $task){
        if($task['done']){
            if($task['priority'] == 1){
                $prio = 'high';
                $prioCounter[$prio]++;
            } elseif($task['priority'] == 2){
                $prio = 'medium';
                $prioCounter[$prio]++;
            } else {
                $prio = 'low';
                $prioCounter[$prio]++;
            }
            echo "✅ " . ($index + 1) . ". " . $task['name'] . " (Priority: " . $prio .")\n";
        }
    }
    echo"--------------------------------------------------------\n";
    echo"Tasks per priority: 🟥 High:" . $prioCounter['high'] . " | 🟧 Medium:" . $prioCounter['medium'] . " | 🟨 Low:" . $prioCounter['low'] . "\n";
}

function deleteTask(&$tasks) {
    $completedTask = (int)getUserInputs("Which task do you wanna delete? ");
    $taskIndex = $completedTask - 1;

    if (isset($tasks[$taskIndex])) {
        unset($tasks[$taskIndex]);
    } else {
        echo "\n⚠️  - Invalid task number.\n";
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
        
        case '5':
            deleteTask($tasks);
            break;
        
        case '0':
            $running = shutDown();
            break;

        default:
            echo "\n❌ Invalid option. Try again.\n";
    }
}