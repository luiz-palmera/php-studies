<?php

class Task {
    private int $id;
    private string $name;
    private int $priority;
    private bool $done;

    // Constructor called when a Task object is created.
    public function __construct(int $id, string $name, int $priority){
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
        $this->done = false;
    }

    public function markAsDone(): void {
        $done->true;
    }

    public function isDone(): bool{
        return $this->done;
    }

    public function getPriorityLabel(): string{
        return match ($this->priority) {
            1 => 'High',
            2 => 'Medium',
            3 => 'Low',
            default => 'Unknown',
        };
    }

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getPriority(): bool{
        return $this->priority;
    }
}