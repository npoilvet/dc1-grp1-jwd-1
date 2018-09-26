<?php
require_once '../../security.php';
require_once '../../../model/database.php';

$titre = $_POST['titre'];

insertCategorie($titre);

header('Location: index.php');