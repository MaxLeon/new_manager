<!DOCTYPE html>
<?php
/** 
 *Create View
 *
 *Verificacion de autenticidad.
 *
 * @category Create
 * @package  Src
 * @author   Maximo De Leon <maximo@mctekk.com>
 * @version  "CVS: 5.5"
 * @link     http://maxnews.com/src/NewsController.php
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

<html> <head> <title>Crear</title> </head> 
<body>

<h1>Crear</h1>

<form method="POST" action="CreateNews.php"> Titulo: <br>
	<input type="text" name="title" value=""> <br>
	<br> Autor: <br>
	<input type="text" name="author" value=""> <br>
	<br> Cuerpo: <br> 
	<textarea name='body' rows='10' cols='40'></textarea> <br><br> 
	<input type='submit' name='create' value='Crear'> 
	<input type='submit' name='cancel' value='Cancelar'>

</form> 
</body> </html>