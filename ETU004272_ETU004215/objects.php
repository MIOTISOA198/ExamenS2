<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$categories = getCategories($pdo);
$id_categorie = isset($_GET['id_categorie']) ? (int)$_GET['id_categorie'] : null;
$objects = getObjects($pdo, $id_categorie);
?>

<?php include 'includes/header.php'; ?>

<h2>Liste des objets</h2>
<div class="filter-container">
    <form method="GET" action="">
        <label for="id_categorie" class="form-label">Filtrer par catégorie</label>
        <select class="form-control" id="id_categorie" name="id_categorie" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?php echo $categorie['id_categorie']; ?>" <?php echo $id_categorie == $categorie['id_categorie'] ? 'selected' : ''; ?>>
                    <?php echo ($categorie['nom_categorie']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>
<div class="row">
    <?php foreach ($objects as $objet): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php
                $stmt = $pdo->prepare("SELECT nom_image FROM images_objet WHERE id_objet = ? LIMIT 1");
                $stmt->execute([$objet['id_objet']]);
                $image = $stmt->fetchColumn();
                ?>
                <img src="assets/images/<?php echo $image ? ($image) : 'default.jpg'; ?>" class="card-img-top" alt="<?php echo ($objet['nom_objet']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ($objet['nom_objet']); ?></h5>
                    <p class="card-text">Catégorie: <?php echo ($objet['nom_categorie']); ?></p>
                    <p class="card-text">Propriétaire: <?php echo ($objet['proprietaire']); ?></p>
                    <?php if ($objet['date_retour']): ?>
                        <p class="card-text text-danger">Retour prévu: <?php echo date('d/m/Y', strtotime($objet['date_retour'])); ?></p>
                    <?php else: ?>
                        <p class="card-text text-success">Disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>