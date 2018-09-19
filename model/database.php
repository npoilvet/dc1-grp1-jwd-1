<?php

require_once 'config/parameters.php';

$connection = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_pass, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR';",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);

// Chargement des fichiers fonctions dans le dossier "entities"

$files = scandir(__DIR__ . "/entities/");
foreach ($files as $file) {
    $filepath = __DIR__ . "/entities/" . $file;
    if (is_file($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) == "php") {
        require_once $filepath;
    }
}

/**
 * Rechercher les données d'une entité
 * @param string $table Nom de la table
 * @param int $id Identifiant de l'identité
 * @return array Les données de l'identité recherchée
 */

function getEntity(string $table, int $id): array {
    global $connection;
    
    $query = "SELECT * FROM $table WHERE id = :id";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    return $stmt->fetch();
}

function getAllEntities(string $table): array {
    global $connection;
    $query = "SELECT * FROM $table";

    $stmt = $connection->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();

}
