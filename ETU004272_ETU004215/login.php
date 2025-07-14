<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: objects.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $sql = sprintf("SELECT * FROM membre WHERE email = '%s'", mysqli_real_escape_string($mysqli, $email));
        $result = mysqli_query($mysqli, $sql);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($user && verifyPassword($password, $user['mdp'])) {
            $_SESSION['id_membre'] = $user['id_membre'];
            header('Location: objects.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    } else {
        $error = 'Veuillez remplir tous les champs.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>Connexion</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo ($error); ?></div>
<?php endif; ?>
<form method="POST" action="">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
<p class="mt-3">Pas de compte ? <a href="register.php">Inscrivez-vous</a></p>
<?php include 'includes/footer.php'; ?>