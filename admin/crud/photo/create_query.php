<?php
require_once '../../security.php';
require_once '../../../model/database.php';

$titre = $_POST['titre'];
$description = $_POST['description'];
$categorie_id = $_POST['categorie_id'];
$tag_ids = isset($_POST['tag_ids']) ? $_POST['tag_ids'] : [];

// Upload de l'image
$filename = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
move_uploaded_file($tmp, "../../../uploads/" . $filename);

insertPhoto($titre, $filename, $description, $categorie_id, $tag_ids);

header('Location: index.php');