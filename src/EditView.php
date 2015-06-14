<!DOCTYPE html>
<?php
/**
 * 
 */
session_start();

$idUser = $_SESSION['id_hash'];

if (!isset($idUser)) {

    echo '<script>';
    echo 'alert("No posee autorizacion para accesar")';
    echo '</script>';
    die();

}

    ?>
<html>
<head>
<title>Editar</title>
</head>
<body>

<h1>Panel de edicion</h1>
</body>
</html>
