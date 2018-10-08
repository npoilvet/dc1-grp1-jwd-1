<?php
require_once '../../../model/database.php';

$liste_commentaires = getAllEntities("commentaire");

$error_msg = null;
if (isset($_GET['errcode'])) {
    $errcode = $_GET['errcode'];
    switch ($errcode) {
        case 23000:
            $error_msg = "Erreur de la suppression !";
            break;
        default :
            $error_msg = "Une erreur est survenue !";
            break;
    }
}

require_once '../../layout/header.php';
?>

<h1>Gestion des commentaires</h1>

<a class="btn btn-success" href="create.php">
    <i class="fa fa-plus"></i>
    Ajouter
</a>

<hr>

<?php if($error_msg) : ?>
<div class="alert alert-danger">
    <i class="fa fa-times"></i>
    <?php echo  $error_msg; ?>
</div>
<?php endif; ?>

<table class="table table-striped table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Photo</th>
        <th>Contenu</th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($liste_commentaires as $commentaire) : ?>
    <tr>
        <td></td>
        <td><?php echo $commentaire['contenu']; ?></td>
        <td class="actions">
            <a class="btn btn-warning" href="update.php?id=<?php echo $commentaire['id']; ?>">
                <i class="fa fa-edit"></i>
                Modifier
            </a>
            <form action="delete_query.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $commentaire['id']; ?>">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Supprimer
                </button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../../layout/footer.php'; ?>
