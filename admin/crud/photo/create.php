<?php
require_once '../../layout/header.php';

require_once '../../../model/database.php';

$liste_categorie = getAllEntities('categorie');
$liste_tag = getAllEntities('tag');
?>

<h1>Ajout d'une photo</h1>

    <form action="create_query.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Titre</label>
            <input class="form-control" type="text" name="titre" placeholder="Titre" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                <?php foreach ($liste_categorie as $categorie): ?>
                <option value="<?php echo $categorie['id']; ?>">
                    <?php echo $categorie['titre']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <select name="tag_ids[]" multiple class="form-control">
                <?php foreach ($liste_tag as $tag): ?>
                    <option value="<?php echo $tag['id']; ?>">
                        <?php echo $tag['titre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn btn-success" type="submit">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once '../../layout/footer.php'; ?>