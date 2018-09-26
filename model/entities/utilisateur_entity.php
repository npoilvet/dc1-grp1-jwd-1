<?php

function getUtilisateurByEmailMotDePasse(string $email, string $mot_de_passe) {
    global $connection;

    $query = "SELECT * FROM utilisateur WHERE email= :email AND mot_de_passe = SHA1(:mot_de_passe)";

    $stmt = $connection->prepare($query);
    $stmt->bindParam('email', $email);
    $stmt->bindParam('mot_de_passe', $mot_de_passe);
    $stmt->execute();

    return $stmt->fetch();
}