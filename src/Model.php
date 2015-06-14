<?php  namespace News;
use PDO;
/**
 * Clase representativa del enlace con la base de datos y
 * Manejadora de la interaccion con la misma
 *
 * @package Src
 *
 * @author Maximo De Leon <maximo@mctekk.com>
 */
Class Model
{

    private static $_db=null;

    /**
     * Funcion la cual crea la connecion con la base de datos recibiendo la ip
     * y el nombre de la base de datos
     * 
     * @param IP     $ip           ip del host
     * @param string $databasename nombre de la base de datos
     *
     * @return null
     */
    public function connect($ip, $databasename)
    {

        try {
            self::$_db = new PDO("mysql:host=$ip;dbname=$databasename;charset=utf8", 'maximo', '1234');
            self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
                
            return "Fallo la conexion: " . $e->getMessage();
        }

    }

    /**
     * Funcion que inserta la data dentro de la base de datos
     *
     * @param array $data data a insertar dentro de la base de datos
     *
     * @return integer id de la data insertada en la base de datos
     */
    public function insert($data)
    {

        $data2=$this->_cleaner($data);

        
        $insert = self::$_db->prepare("INSERT INTO news (news_title, news_body, news_author) VALUES (:tittle, :body, :author)");
        $insert->bindParam(':tittle', $data2[0], PDO::PARAM_STR);
        $insert->bindParam(':body', $data2[1], PDO::PARAM_STR);
        $insert->bindParam(':author', $data2[2], PDO::PARAM_STR);
        $insert->execute();
        
        return self::$_db->lastInsertId();

    }

    /**
     * Funcion que busca dentro de la base de datos 
     *
     *@param array $searchData data a buscar en la base de datos
     *
     *@return array la data buscada
     */
    public function search($searchData)
    {

        $data2=$this->_cleaner($searchData);


        $thing = $data2[0];
        $table = $data2[1];
        $colum = $data2[2];
        $data = $data2[3];

        $select = self::$_db->prepare("SELECT $thing FROM $table WHERE $colum = :data");
        
        $select->bindParam(':data', $data, PDO::PARAM_STR);

        $select->execute();

        $select->setFetchMode(PDO::FETCH_ASSOC);

        return $select->fetchAll();

    }

    /**
     * Funcion que actualiza la informacion dentro de la base de datos
     *
     *@param array $arr arreglo que contiene la data a editar
     *
     *@return integer el total de filas fueron modificadas
     */
    public function update($arry)
    {
        $arr=$this->_cleaner($arry);
        print_r($arr);
        $table=$arr[0];        
        $update = self::$_db->prepare("UPDATE $table SET news_title=:tittle, news_body=:body, news_author=:author WHERE id=:id");

        $update->bindParam(':tittle', $arr[1]);
        $update->bindParam(':body', $arr[2]);
        $update->bindParam(':author', $arr[3]);
        $update->bindParam(':id', $arr[4]);
            
        $update->execute();

        return $update->rowCount();
    }

    /**
     * Funcion que borra una fila de la base de datos
     *
     *@param string $table tabla en la cual se borrara
     *@param string $where columna en la cual se borrara
     *@param string $thing parametro concatenado a la columna
     *
     *@return integer las filas que fueron modificadas
     */
    public function delete($table, $where, $thing)
    {

        $delete=self::$_db->prepare("DELETE FROM $table WHERE $where=$thing");

        $delete->execute();

         return $delete->rowCount();
    }

    /**
     * Funcion que valida la data insertada y convierte datos html en texto plano
     *
     *@param array $data arreglo de la data a insertar
     *
     *@return los datos convertidos
     */
    private function _cleaner($data)
    {

        $cleanedData=[];

        foreach ($data as $value) {

            $htmlTrans = htmlspecialchars($value, ENT_QUOTES);
            $filtred = filter_var($htmlTrans, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            $cleanedData[]=$filtred;


                
        }
        return $cleanedData;

    }

}
?>
