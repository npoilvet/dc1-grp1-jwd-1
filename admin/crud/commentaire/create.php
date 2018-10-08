<?php

require_once '../../layout/header.php';
?>

<h1>Ajout d'un tag</h1>

    <form action="create_query.php" method="POST">
        <div class="form-group">
            <label>Titre</label>
            <input class="form-control" type="text" name="titre" placeholder="Titre" required>
        </div>
        <button class="btn btn-success" type="submit">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once '../../layout/footer.php'; ?>