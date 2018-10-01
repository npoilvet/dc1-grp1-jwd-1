<?php

function insertCategorie(string $titre) {
    global $connection;

    $query = "INSERT INTO categorie (titre) VALUES (:titre)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->execute();
}

function updateCategorie(int $id, string $titre) {
    global $connection;

    $query = "UPDATE categorie SET titre = :titre WHERE id= :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}