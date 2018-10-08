<?php

function getAllPhotos(int $limit= 999): array {
    global $connection;

    $query = "SELECT
                photo. *,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS 'categorie'
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            ORDER BY photo.date_creation DESC
            LIMIT :limit;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":limit", $limit);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getPhoto(int $id): array {
    global $connection;

    $query = "SELECT
                photo.id,
                photo.titre,
                photo.image,
                photo.nb_likes,
                photo.date_creation,
                photo.description,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS 'categorie'
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE photo.id = :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}

function getAllPhotosByTag(int $id): array {
    global $connection;

    $query = "SELECT
                photo. *,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS categorie
            FROM photo
            INNER JOIN photo_has_tag ON photo_has_tag.photo_id = photo.id
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE photo_has_tag.tag_id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getAllPhotosByCategorie(int $id): array {
    global $connection;

    $query = "SELECT
                photo. *,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS categorie
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE categorie.id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function insertPhoto (string $titre, string $image, string $description, string $categorie_id, array $tag_ids) {
    /* @var $connection PDO */
    global $connection;

    $query = "INSERT INTO photo (titre, image, nb_likes, date_creation, description, categorie_id)
              VALUES (:titre, :image, 0, NOW(), :description, :categorie_id)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":titre",$titre);
    $stmt->bindParam(":image",$image);
    $stmt->bindParam(":description",$description);
    $stmt->bindParam(":categorie_id",$categorie_id);

    $stmt->execute();

    $id = $connection->lastInsertId();

    foreach ($tag_ids as $tag_id) {
        insertPhotoHasTag($id, $tag_id);
    }
}

function insertPhotoHasTag(int $photo_id, int $tag_id) {
    /* @var $connection PDO */
    global $connection;

    $query = "INSERT INTO photo_has_tag (photo_id, tag_id)
              VALUES (:photo_id, :tag_id)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":photo_id",$photo_id);
    $stmt->bindParam(":tag_id",$tag_id);

    $stmt->execute();
}

function updatePhoto (int $id, string $titre, string $image, string $description, string $categorie_id, array $tag_ids) {
    /* @var $connection PDO */
    global $connection;

    $query = "UPDATE photo SET 
                      titre = :titre,
                      image = :image,
                      description = :description,
                      categorie_id = :categorie_id
              WHERE id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id",$id);
    $stmt->bindParam(":titre",$titre);
    $stmt->bindParam(":image",$image);
    $stmt->bindParam(":description",$description);
    $stmt->bindParam(":categorie_id",$categorie_id);

    $stmt->execute();

    deletePhotoHasTag($id);

    foreach ($tag_ids as $tag_id) {
        insertPhotoHasTag($id, $tag_id);
    }
}

function deletePhotoHasTag(int $photo_id) {
    /* @var $connection PDO */
    global $connection;

    $query = "DELETE FROM photo_has_tag
              WHERE photo_id = :photo_id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":photo_id",$photo_id);

    $stmt->execute();
}
