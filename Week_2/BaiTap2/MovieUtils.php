<?php
require_once 'Movie.php';
function findMovieById($movies, $id) {
    foreach ($movies as $movie) {
        if ($movie->getId() === $id) {
            return $movie;
        }
    }
    return null;
}

function getTotalRevenue($movies) {
    $totalRevenue = 0;
    foreach ($movies as $movie) {
        $totalRevenue += $movie->getRevenue();
    }
    return $totalRevenue;
}

function getBestSellingMovie($movies) {
    if (empty($movies)) {
        return null;
    }
    $best = $movies[0];
    foreach ($movies as $movie) {
        if ($movie->getSoldSeats() > $best->getSoldSeats()) {
            $best = $movie;
        }
    }
    return $best;
}
?>