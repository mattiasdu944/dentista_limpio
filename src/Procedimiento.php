<?php

namespace Mattias\Dentista;

class Procedimiento{

    private  $tipo_procedimiento, $estado, $costo,$id;

    public function __construct( $tipo_procedimiento, $estado, $costo,$id=null){
        $this->id = $id; 
        $this->tipo_procedimiento = $tipo_procedimiento;
        $this->estado = $estado; 
        $this->costo = $costo; 
    }

    // FUNCION PARA INSERTAR
    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO procedimiento(id, tipo_procedimiento, estado, costo) VALUE (:id, :tipo_procedimiento, :estado, :costo)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":id",$this->id);
        $sentencia->bindValue(":tipo_procedimiento",$this->tipo_procedimiento);
        $sentencia->bindValue(":estado",$this->estado);
        $sentencia->bindValue(":costo",$this->costo);
        return $sentencia->execute();
    }


    // LISTAR ELEMENTOS DE BD
    public static function listarTodo(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM procedimiento";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Procedimiento',array(null,null,null,null));
        return $sentencia->fetchAll();
    }

    // LISTAR ELEMENTOS DE BD
    public static function listarActivos(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM procedimiento WHERE estado = 1";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Procedimiento',array(null,null,null,null));
        return $sentencia->fetchAll();
    }

    public function modificar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "UPDATE procedimiento SET tipo_procedimiento = :tipo_procedimiento, estado = :estado , costo = :costo WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":tipo_procedimiento",$this->tipo_procedimiento);
        $sentencia->bindValue(":estado",$this->estado);
        $sentencia->bindValue(":costo",$this->costo);
        $sentencia->bindValue(":id",$this->id);
        return $sentencia->execute();
    }
    
    public function eliminar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "DELETE FROM procedimiento WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindParam(':id',$this->id);
        return $sentencia->execute();
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of tipo_procedimiento
     */ 
    public function getTipo_procedimiento()
    {
        return $this->tipo_procedimiento;
    }

    /**
     * Set the value of tipo_procedimiento
     *
     * @return  self
     */ 
    public function setTipo_procedimiento($tipo_procedimiento)
    {
        $this->tipo_procedimiento = $tipo_procedimiento;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of costo
     */ 
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }
}
?>