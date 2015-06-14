<!DOCTYPE html>
<?php
session_start();

$idUser = $_SESSION['id_hash'];

$Username = $_SESSION['user'];

if (!isset($idUser)) {

    echo '<script>';
    echo 'alert("No posee autorizacion para accesar")'; 
    echo '</script>';
    die();
} else {

    echo "<h1>Bienvenido $Username</h1>";
}

    ?>
<html>
<head>
<title>News</title>
</head>
<body>
<h1>News of the day</h1>

<form method="POST" action="NewsController.php">

	<input type="button" name="crear" value="Crear" 
		onclick="window.open('CreateNews.php','_self')"/>
	<br><br>

</form>
</body>
</html>
