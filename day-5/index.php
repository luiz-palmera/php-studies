<?php

require_once __DIR__ . "/classes/Task.php";
require_once __DIR__ . "/classes/TaskManager.php";

$manager = new TaskManager();

$running = true;

while($running) {
    echo "\n[1] Add\n[2] List\n[3] Complete\n[4] Delete\n[0] Exit\n";
    $choice = readline("Choose: ");

    switch($choice) {
        case '1':
            $name = readline("Task name: ");
            $priorityInput = readline("Priority (high, medium, low): ");
            $priority = match (strtolower($priorityInput)) {
                'high' => 1,
                'medium' => 2,
                'low' => 3,
                default => 3,
            };
            $manager->addTask($name, $priority);
            break;
        case '2':
            $manager->listTasks();
            break;
        case '3':
            $id = (int)readline("Task number: ");
            $manager->deleteTask($id);
            break;
        case '0':
            $running = false;
            echo "Bye!\n";
            break;
        default:
            echo "Invalid. \n";
    }
}