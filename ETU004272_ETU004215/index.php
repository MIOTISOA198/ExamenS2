<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: objects.php');
} else {
    header('Location: login.php');
}
exit;
?>