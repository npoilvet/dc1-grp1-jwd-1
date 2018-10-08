<?php require_once __DIR__ . '/../../functions.php'; ?>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo isActive("/admin/", true) ? 'active' : ''; ?>" href="<?php echo $siteadmin; ?>">
                    <i class="fa fa-home"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isActive("/crud/photo/") ? 'active' : ''; ?>" href="<?php echo $siteadmin; ?>crud/photo/">
                    <i class="fa fa-picture-o"></i>
                    Photos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isActive("/crud/categorie/") ? 'active' : ''; ?>" href="<?php echo $siteadmin; ?>crud/categorie/">
                    <i class="fa fa-book"></i>
                    Catégories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isActive("/crud/tag/") ? 'active' : ''; ?>" href="<?php echo $siteadmin; ?>/crud/tag">
                    <i class="fa fa-tags"></i>
                    Tags
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isActive("/crud/commentaire/") ? 'active' : ''; ?>" href="<?php echo $siteadmin; ?>/crud/commentaire">
                    <i class="fa fa-comments"></i>
                    Commentaires
                </a>
            </li>
        </ul>
    </div>
</nav>