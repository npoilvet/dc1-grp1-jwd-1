<?php
require_once '../../security.php';
require_once '../../../model/database.php';

$id = $_POST['id'];
$titre = $_POST['titre'];

updateCategorie($id, $titre);

header('Location: index.php');