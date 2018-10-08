<?php

require_once '../../../model/database.php';

$liste_categorie = getAllEntities('categorie');
$liste_tag = getAllEntities('tag');
$id = $_GET['id'];
$photo = getEntity("photo", $id);
$photo_liste_tags = getAllTagsByPhoto($id);
$photo_liste_tags_ids = [];
foreach ($photo_liste_tags as $tag) {
    $photo_liste_tags_ids[] = $tag['id'];
}

require_once '../../layout/header.php';
?>

    <h1>Modification d'une photo</h1>

    <form action="update_query.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Titre</label>
            <input class="form-control" type="text" name="titre" placeholder="Titre" value="<?php echo $photo['titre']; ?>" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <?php if($photo['image']): ?>
                <img src="../../../uploads/<?php echo $photo['image']; ?>" class="img-thumbnail">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"><?php echo $photo['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                <?php foreach ($liste_categorie as $categorie): ?>
                <?php $selected = ($categorie['id'] == $photo['categorie_id']) ? "selected" : "" ?>
                    <option value="<?php echo $categorie['id']; ?>" <?php echo $selected; ?>>
                        <?php echo $categorie['titre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <select name="tag_ids[]" multiple class="form-control">
                <?php foreach ($liste_tag as $tag): ?>
                    <?php $selected = (in_array($tag['id'], $photo_liste_tags_ids)) ? "selected" : ""; ?>
                    <option value="<?php echo $tag['id']; ?>" <?php echo $selected; ?>>
                        <?php echo $tag['titre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button class="btn btn-success" type="submit">
            <i class="fa fa-check"></i>
            Modifier
        </button>
    </form>

<?php require_once '../../layout/footer.php'; ?>