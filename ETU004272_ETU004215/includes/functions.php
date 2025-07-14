<?php
require_once 'config.php';

function isLoggedIn() {
    return isset($_SESSION['id_membre']);
}

// Hacher le mot de passe
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Vérifier le mot de passe
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Obtenir les catégories
function getCategories($mysqli) {
    $result = mysqli_query($mysqli, "SELECT * FROM categorie_objet");
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    mysqli_free_result($result);
    return $categories;
}

// Obtenir les objets avec filtre par catégorie
function getObjects($mysqli, $id_categorie = null) {
    $sql = "SELECT o.*, c.nom_categorie, m.nom AS proprietaire, e.date_retour
            FROM objet o
            JOIN categorie_objet c ON o.id_categorie = c.id_categorie
            JOIN membre m ON o.id_membre = m.id_membre
            LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour > NOW()";
    if ($id_categorie) {
        $sql = sprintf("SELECT o.*, c.nom_categorie, m.nom AS proprietaire, e.date_retour
                        FROM objet o
                        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
                        JOIN membre m ON o.id_membre = m.id_membre
                        LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour > NOW()
                        WHERE o.id_categorie = %d", $id_categorie);
    }
    $result = mysqli_query($mysqli, $sql);
    $objects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objects[] = $row;
    }
    mysqli_free_result($result);
    return $objects;
}
?>