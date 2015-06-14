<?php 
	require '../configuration.php';
    require '../vendor/autoload.php';
    use News\Model;
//Bind param-
//Verificar antes de borrar-
//Verificar antes de editar-
//Login directo con la db
//Hash password
//Usar cookies

//Pasamos a Phalcon

 $connect = new Model();
 $connect->connect($IPDB, $DBNAME);

 $arrtotest = array("users", "user", 1);

 $salida = $connect->insert($arrtotest);

 ?>