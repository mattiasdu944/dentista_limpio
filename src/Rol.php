<?php 
namespace Mattias\Dentista;
class Rol
{
    private $descripcion, $id;
    public function __construct( $descripcion, $id=null)
    {
        $this->descripcion = $descripcion;
        $this->id = $id;
    }
    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM roles";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Rol',array(null));
        return $sentencia->fetchAll();
    }
    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getid()
    {
        return $this->id;
    }
}

?>