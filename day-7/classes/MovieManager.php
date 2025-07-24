<?php

require_once "Movie.php";

class MovieManager {
    private array $movies = [];
    private string $dataFile;

    public function __construct(string $dataFile = __DIR__ . '/../data/movies.json'){
        $this->dataFile = $dataFile;
        $this->loadMovies();
    }

    public function loadMovies(): void {
        if(file_exists($this->dataFile)){
            $json = file_get_contents($this->dataFile);
            $data = json_decode($json, true);

            foreach($data as $item) {
                $this->movies[] = new Movie(
                    $item['id'],
                    $item['title'],
                    $item['year'],
                    $item['watched']
                );
            }
        }
    }  
    
    private function saveMovies(): void{
        $data = array_map(function ($movie){
            return[
                'id' => $movie->getId(),
                'title' => $movie->getTitle(),
                'year' => $movie->getYear(),
                'watched' => $movie->getWatched(),
            ];
        }, $this->movies);

        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function addMovie(string $title, int $year, bool $watched): void{
        foreach($this->movies as $movie){
            if($movie->getTitle() === $title){
                echo "⚠️ This movie already is on the list. \n";
                return;
            }
        }
        $id = count($this->movies) + 1;
        $this->movies[] = new Movie($id, $title, $year, $watched);
        $this->saveMovies();
    }

    public function markAsWatched(int $id): void{
        if (!isset($this->movies[$id])) {
            echo "⚠️ Movie not found.\n";
            return;
        }

        $movie = $this->movies[$id];

        if ($movie->getWatched()) {
            echo "⚠️ You already watched this movie.\n";
            return;
        }

        $movie->setWatched(true);
        $this->saveMovies();
    }

    public function listMovies(): void{
        if(empty($this->movies)){
            echo " ⚠️ Can't find any movie, please add your first movie!";
            return;
        }

        echo "\n--------- Movie List ---------\n";
        foreach($this->movies as $movie){
            echo $movie;
        }
        echo "------------------------------\n";
    }

    public function listWatched(): void{
        if(empty($this->movies)){
            echo " ⚠️ Can't find any movie, please add your first movie!";
            return;
        }
        echo "\n--------- Watched Movies ---------\n";
        $found = false;
        foreach($this->movies as $movie){
            if($movie->getWatched()){
                echo $movie;
                return;
                $found= true;
            }
        }

        if(!$found){
            echo "😢 No watched movies yet.\n";
        }
        echo "----------------------------------\n";
    }


}