<?php

$tasks = [];

$running = true;

$counter = 0;

while($running){ 

    echo("\n📋 Task manager\n");
    echo("\n[1] Add task \n[2] List tasks \n[3] Mark as completed \n[0] Exit\n");
    $option = readline("\nChoose one option: ");

    switch($option){
        case '1': 
            $newTask = readline("\nType your task: ");
            $tasks[$counter] = [
                'id' => ($counter + 1),
                'name' => $newTask,
                'done' => false, 
            ];
            $counter++;
            break;

        case '2':
            echo("\nYour task list:\n");
            foreach($tasks as $index => $task){
                $completed = $task['done'] ? '✅' : '⬜';
                echo "$completed " . ($index + 1) . ". " . $task['name'] . "\n";
            }
            break;

        case '3':
            $completedTask = (int)readline("Which task do you wanna complete? ");
            $taskIndex = $completedTask - 1;
            if (isset($tasks[$taskIndex])) {
                $tasks[$taskIndex]['done'] = true;
            } else {
                echo "⚠️ Invalid task number.\n";
            }
            
        case '0':
            echo("\nShutting down...");
            $running = false;
            break;

        default:
            echo("❌ Invalid option. Try again.\n");
    }
};
