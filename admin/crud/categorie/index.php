<?php
require_once '../../../model/database.php';

$liste_categories = getAllEntities("categorie");

require_once '../../layout/header.php';
?>

<h1>Gestion des catégories</h1>

<a class="btn btn-success" href="create.php">
    <i class="fa fa-plus"></i>
    Ajouter
</a>

<hr>

<table class="table table-striped table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Titre</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($liste_categories as $categorie) : ?>
    <tr>
        <td><?php echo $categorie['titre']; ?></td>
        <td></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../../layout/footer.php'; ?>
