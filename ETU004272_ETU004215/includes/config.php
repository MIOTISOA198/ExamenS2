<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'final_project';

$mysqli = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
    die(sprintf("Erreur de connexion : %s", mysqli_connect_error()));
}

mysqli_set_charset($mysqli, "utf8");
?>