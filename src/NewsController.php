<?php namespace News;
    
    require '../configuration.php';
    require '../vendor/autoload.php';
    use News\Model;
    require 'NewsView.php';

    $connect = new Model();
    $connect->connect($IPDB, $DBNAME);
    $news=array("*","news", 1,1 );


    $get=$connect->search($news);

    


foreach ($get as $key => $value) {

    $id=$value['id'];
    //echo $key;
    echo "<br>";
    //print_r($value);
    print_r($value['news_title']);
    echo "<br>";
    print_r($value['news_author']);
    echo "<br>";
    print_r($value['news_body']);
    
    echo "<form method='post' action=''>";
    echo"<input type='hidden' name='key' value='$id'>";
    echo"<input type='submit' id='$key' name='task' value='Editar'>";
    echo " ";
    echo"<input type='submit' id='$key' name='task' value='Borrar'>";
    echo "</form>";
    echo "<br>";
}

    


if (isset($_POST['task'])) {

    switch ($_POST['task']) {
            
    case 'Editar':
        $id=$_POST['key'];
            
        header("Location: /src/EditController.php?id=$id");
                
        break;

    case 'Borrar':

        $arr = array("id", "news", "id", $_POST['key']);
        $output=$connect->search($arr);
        $back=$output[0];

        if ($back['id']==$_POST['key']) {

            ?>

            <script>
            
            confirmacion = confirm('Desea borrar esta noticia');

            if(confirmacion){

                window.location.href="NewsController.php"
                <?php  $connect->delete("news", "id", $_POST['key']); ?>
            }else{

                alert('ha cancelado la accion!');
            }
            
            </script> 

        <?php
        } else {

            echo "<script>";
            echo "alert('no coinciden los campos a borrar')";
            echo "</script>";
        }
                
        break;
            
    }

}


    ?>

