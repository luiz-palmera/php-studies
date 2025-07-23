<?php

class Movie {
    private int $id;
    private string $title;
    private int $year;
    private bool $watched;

    public function __construct(int $id, string $title, int $year) {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->watched = false;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getTitle(): string{
        return $this->title;
    }

    public function getYear(): int{
        return $this->year;
    }

    public function getWatched(): bool{
        return $this->watched;
    }

    public function setTitle(string $title) : void{
        $this->title = $title;
    }

    public function setYear(int $year) : void{
        $this->year = $year;
    }

    
    public function setWatched(bool $watched) : void{
        $this->watched = $watched;
    }

    public function __toString(): string{
        $status = $this->watched ? "✅ Watched\n" : "⬜ Not watched\n";
        return "{$this->title} ({$this->year}) - {$status}";
    }

}