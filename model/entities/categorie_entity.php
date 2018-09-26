<?php

function insertCategorie(string $titre) {
    global $connection;

    $query = "INSERT INTO categorie (titre) VALUES (:titre)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->execute();
}