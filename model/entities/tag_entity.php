<?php

function getAllTagsByPhoto(int $id): array {
    global $connection;

    $query = "SELECT
                tag.id,
                tag.titre
            FROM tag
            INNER JOIN photo_has_tag ON photo_has_tag.tag_id = tag.id
            WHERE photo_has_tag.photo_id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function insertTag(string $titre) {
    global $connection;

    $query = "INSERT INTO tag (titre) VALUES (:titre)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->execute();
}

function updateTag(int $id, string $titre) {
    global $connection;

    $query = "UPDATE tag SET titre = :titre WHERE id= :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}