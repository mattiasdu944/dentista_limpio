<?php 
namespace Mattias\Dentista;

class Consultorio
{
    private $direccion,$horarios,$id;
    public function __construct($direccion,$horarios,$id=null)
    {
        $this->direccion=$direccion;
        $this->horarios=$horarios;
        $this->id=$id;      
    }

    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM consultorio";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Consultorio',array(null,null,null));
        return $sentencia->fetchAll(); 
    }

    public static function listarJoin(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT c.id, c.direccion, c.horarios, h.dias, h.horas FROM consultorio as c INNER JOIN horarios as h ON c.horarios = h.id";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_OBJ);
        return $sentencia->fetchAll();
    }


    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO consultorio (direccion, horarios) VALUES(:direccion, :horarios)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":direccion",$this -> direccion);
        $sentencia->bindValue(":horarios" ,$this->horarios);
        return $sentencia->execute();
    }

    public function modificar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "UPDATE consultorio SET  direccion = :direccion ,horarios=:horarios WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":direccion",$this -> direccion);
        $sentencia->bindValue(":horarios" ,$this->horarios);
        $sentencia->bindValue(":id",$this->id);
        return $sentencia->execute();
    }
    
    public function eliminar(Db $db){
         
        $c = $db->getConexion();
        $sql = "DELETE FROM consultorio WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":id",$this->id);
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
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of horarios
     */ 
    public function getHorarios()
    {
        return $this->horarios;
    }

    /**
     * Set the value of horarios
     *
     * @return  self
     */ 
    public function setHorarios($horarios)
    {
        $this->horarios = $horarios;

        return $this;
    }

    /**
     * Get the value of procedimiento
     */ 
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set the value of procedimiento
     *
     * @return  self
     */ 
    public function setProcedimiento($procedimiento)
    {
        $this->procedimiento = $procedimiento;

        return $this;
    }
}


?>