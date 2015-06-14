<?php 
/**
 *  En este archivo se encarga de la edicion de noticias
 *  Edit Controller
 * @category News
 * @package  Src
 * @author   Maximo De Leon <maximo@mctekk.com>
 * @version  "CVS: 5.5"
 * @link     http://maxnews.com/src/NewsController.php
 */
 namespace News;
    require 'EditView.php';
    require '../configuration.php';
    require '../vendor/autoload.php';
    use News\Model; 

    $edit = new Model();
    $edit->connect($IPDB, $DBNAME);
    $news=array("news_title, news_body, news_author", "news", "id" , $_GET['id']);

    $theArr=$edit->search($news);


    $theNew=$theArr[0];

    echo "<form method='POST' action=''>
	Titulo: <br>
	<input type='text' name='title' value='$theNew[news_title]'>
	<br>
	<br>
	Autor: <br>
	<input type='text' name='author' value='$theNew[news_author]'>
	<br><br>
	Cuerpo: <br>
	<textarea name='body' rows='10' cols='40'>$theNew[news_body]</textarea>
	<br><br>
	<input type='submit' name='ok' value='Ok'>";
    echo " ";
    echo "<input type='submit' name='cancelar' value='Home'>";

    
if (isset($_POST['ok']) && $_POST['title'] && $_POST['author'] && $_POST['body']) {
    $edited =[]; 
    $edited[]="news";
    $edited[]=$_POST['title']; 
    $edited[]=$_POST['body'];
    $edited[]=$_POST['author']; 
    $edited[]=$_GET['id'];

    $edit->update($edited);

    $realID=$_GET['id'];


    header("Location: /src/EditController.php?id=$realID");

}

if (isset($_POST['cancelar'])) {

    header("Location: /src/NewsController.php");
        
}



    ?>
