<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: objects.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $image_profil = $_FILES['image_profil']['name'];

    if ($nom && $date_naissance && $genre && $email && $ville && $password) {
        // Vérifier si l'email existe déjà
        $sql = sprintf("SELECT COUNT(*) AS count FROM membre WHERE email = '%s'", mysqli_real_escape_string($mysqli, $email));
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($row['count'] > 0) {
            $error = 'Cet email est déjà utilisé.';
        } else {
            // Gérer l'upload de l'image
            if ($image_profil) {
                $target_dir = "assets/images/";
                $target_file = $target_dir . basename($image_profil);
                move_uploaded_file($_FILES['image_profil']['tmp_name'], $target_file);
            } else {
                $image_profil = null;
            }

            // Insérer le membre
            $hashed_password = hashPassword($password);
            $sql = sprintf("INSERT INTO membre (nom, date_de_naissance, genre, email, ville, mdp, image_profil) 
                            VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %s)",
                            mysqli_real_escape_string($mysqli, $nom),
                            mysqli_real_escape_string($mysqli, $date_naissance),
                            mysqli_real_escape_string($mysqli, $genre),
                            mysqli_real_escape_string($mysqli, $email),
                            mysqli_real_escape_string($mysqli, $ville),
                            mysqli_real_escape_string($mysqli, $hashed_password),
                            $image_profil ? sprintf("'%s'", mysqli_real_escape_string($mysqli, $image_profil)) : 'NULL');
            mysqli_query($mysqli, $sql);
            $_SESSION['id_membre'] = mysqli_insert_id($mysqli);
            header('Location: objects.php');
            exit;
        }
    } else {
        $error = 'Veuillez remplir tous les champs.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>Inscription</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo ($error); ?></div>
<?php endif; ?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
        <label for="date_naissance" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
    </div>
