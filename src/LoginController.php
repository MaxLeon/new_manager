<?php 
/**
 * LoginController
 *
 * En este archivo se realiza la comunicacion
 * entre la base de datos y la vista del login
 *
 * @category Login
 * @package  Src
 * @author   Maximo De Leon <maximo@mctekk.com>
 * @version  "CVS: 5.5"
 * @link     http://maxnews.com/src/NewsController.php
 */
namespace News;

    require 'LoginView.php';
    require '../configuration.php';
    require '../vendor/autoload.php';
    use News\Model;
    $connect = new Model();
    $connect->connect($IPDB, $DBNAME);
    
if (isset($_POST['login'])) {

    if (empty($_POST['user']) && empty($_POST['pass'])) {

        echo '<script>';
        echo 'alert("Debe de suministrar un usuario y una contraseña")';
        echo '</script>';

    } else {

        $user=$_POST['user'];
        $pass=$_POST['pass'];

        $insData = array("*","users","user", $user);

        $val=$connect->search($insData);
                    
        if (!empty($val)) {

            confirm($val[0], $user, $pass);
        } else {

            echo '<script>';
            echo 'alert("El usuario o la contraseña no es correcto")';
            echo '</script>';

        }
    }
}

/**
 * Machea los datos suministrados en el login y realisa el hash del id
 *
 * @param array  $data datos del usario en la base de datos
 * @param string $user usuario sumistrado en ventana de login
 * @param string $pass password sumistrado en la vetana de login
 *
 * @return null
 */ 
function confirm($data, $user, $pass)
{

    if ($data['user']==$user && $data['pass']==$pass) {

        session_start();
            
        $_SESSION['id_hash'] = hashID($data['id']);
        $_SESSION['user'] = $data['user'];

        header('Location: /src/NewsController.php');
            
            
    }
}

/**
 * Funcion que realiza el hash al id del usuario
 *
 * @param integer $id id del usuario dentro de la base de datos
 *
 * @return integer
 */
function hashID($id)
{

    $hash = md5(mt_rand(1, 1000000) . $id);
    
    return $hash;
}


    ?>
