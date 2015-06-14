<?php
/**
 *  Esta es la clase que presenta las noticias en la pantalla principal
 *  Create News
 * @category News
 * @package  Src
 * @author   Maximo De Leon <maximo@mctekk.com>
 * @version  "CVS: 5.5"
 * @link     http://maxnews.com/src/NewsController.php
 */
namespace News;

    require '../configuration.php';
    require '../vendor/autoload.php';
    use News\Model;
    require 'CreateView.php';

    /**
     * Instancia tipo Model la cual hace enlace con la base de datos.
     *@var Model
     */
    $insert = new Model();

    //Se conecta con la base de datos
    $insert->connect($IPDB, $DBNAME);

//Confirma si se ha presionado el boton crear
if (isset($_POST['create'])) {
    //confirma si los campos de titulo, cuerpo y autor estan en blanco
    if (empty($_POST['title']) and empty($_POST['body']) and empty($_POST['author'])) {
        echo "<script>";
        echo "alert('Debes de llenar los campos')";
        echo "</script>";
    } else {
    
        $create = array($_POST['title'], $_POST['body'], $_POST['author']);
        $insert->insert($create);
        header("Location: /src/NewsController.php");
    }
}

//cancela el post de la noticia
if (isset($_POST['cancel'])) {

    header("Location: /src/NewsController.php");
}
?>
