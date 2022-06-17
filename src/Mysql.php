<?php 
namespace Mattias\Dentista;
class Mysql implements Db
{
        public function getConexion()
    {
        require_once("conf.php");
        try {
            $c = new \PDO("mysql:host=".HOST.";dbname=".DBNAME,USR,PASS);
            $c->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo "ERROR EN LA CONEXION: ".$e->getMessage();
        }
        return $c;
    }
}

?>