<?php

require_once "Movie.php";

class MovieManager {
    private array $movies = [];

    public function addMovie(string $title, int $year, bool $watched): void{
        foreach($this->movies as $movie){
            if($movie->getTitle() === $title){
                echo "⚠️ This movie already is on the list. \n";
                return;
            }
        }
        $id = count($this->movies) + 1;
        $this->movies[] = new Movie($id, $title, $year, $watched);
    }

    public function markAsWatched(int $id): void{
        $movie = $this->movies[$id]; 
        if($movie->getWatched() === true){
            echo " ⚠️ You already watched this movie. \n";
            return;
        } else{
            $movie->setWatched(true);
            echo "✅ Movie marked as watched.\n";
        }
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