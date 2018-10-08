<?php

require_once '../../../model/database.php';

$id = $_GET['id'];
$tag = getEntity("tag", $id);

require_once '../../layout/header.php';
?>

    <h1>Modification d'un tag</h1>

    <form action="update_query.php" method="POST">
        <div class="form-group">
            <label>Titre</label>
            <input class="form-control" type="text" value="<?php echo $tag['titre']; ?>" name="titre" placeholder="Titre" required>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button class="btn btn-success" type="submit">
            <i class="fa fa-check"></i>
            Modifier
        </button>
    </form>

<?php require_once '../../layout/footer.php'; ?>