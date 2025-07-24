<?php

require_once __DIR__ . "/classes/Movie.php";
require_once __DIR__ . "/classes/MovieManager.php";

$manager = new MovieManager;
$running = true;

function getInput($message){
    return readline($message);
}

function showMenu(): string{
    echo "\n--------- MovieBoxd ---------\n";
    echo "\n[1] Add a movie\n";
    echo "[2] Mark as watched\n";
    echo "[3] List your movies\n";
    echo "[4] List watched movies\n";
    echo "[0] Exit\n";
    echo "\n-----------------------------\n";

    $selectedOption = readline("What you wanna do? ");
    return $selectedOption;
}

function newMovie(MovieManager $manager) : void{
    $title = getInput("\nWhat's the movie title?");
    $year = getInput("\nWhen it was released (year)?");
    if ($year <= 1800 || $year > date('Y')) {
        echo "❌ Invalid year.\n";
        return;
    }
    $manager->addMovie($title, $year, false);
}

while($running){
    $option = showMenu();
    switch($option){
        case '1':
            newMovie($manager);
            $manager->listMovies();
            break;
        case '2':
            $watchedMovie =(int)getInput("\n Which movie have you seen?");
            if ($watchedMovie < 1) {
                echo "❌ Invalid movie ID.\n";
                break;
            }
            $manager->markAsWatched($watchedMovie - 1);
            break;
        case '3':
            $manager->listMovies();
            break;
        case '4':
            $manager->listWatched();
            break;
        case '0':
            $running = false;
            break;
        default:
            echo "Invalid option. Try again.\n";
    }
}