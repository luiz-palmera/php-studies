<?php

require_once "Task.php";

class TaskManager {
    private array $tasks = [];

    public function addTask(string $name, int $priority): void{
        foreach ($this->tasks as $task) {
            if($task->getName() === $name) {
                echo "⚠️ This task already exists. \n";
                return;
            }
        }

        $id = count($this->tasks) + 1;
        $this->tasks[] = new Task($id, $name, $priority);
    }

    public function listTasks(): void {
        if(empty($this->tasks)) {
            echo "No tasks yet. \n";
            return;
        }

        foreach ($this->tasks as $task){
            $status = $task->isDone() ? '✅' : '⬜';
            echo "{$status} {$task->getId()}. {$task->getName()} (Priority: {$task->getPriorityLabel()})\n";
        }
    }

    public function completeTask(int $taskId): void {
        foreach ($this->task as $task) {
            if($task->getId() === taskId) {
                if($task-> isDone()) {
                    echo " ⚠️ Task already completed. \n";
                }
                $task->markAsDone();
                return;
            }
        }
        echo "⚠️ Task not found. \n";
    }

    public function deleteTask(int $taskId): void{
        foreach ($this->tasks as $index => $task){
            if($task->getId() === $taskId) {
                unset($this->tasks[$index]);
                echo " 🗑 Task delete.\n";
                return;
            }
        }
        echo " ⚠️ Task not found. \n";
    }
}