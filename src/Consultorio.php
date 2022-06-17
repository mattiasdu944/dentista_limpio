<?php 
namespace Mattias\Dentista;

class Consultorio
{
    private $id,$direccion,$horarios,$procedimiento;
    public function __construct($direccion,$horarios,$procedimiento,$id=null)
    {
        $this->id=$id;      
        $this->direccion=$direccion;
        $this->horarios=$horarios;
        $this->procedimiento=$procedimiento;
    }

    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM consultorio";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Consultorio',array(null,null,null,null,null));
        return $sentencia->fetchAll(); 
    }

    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO consultorio (direccion, horarios, procedimiento) VALUES(:direccion, :horarios, :procedimineto)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":direccion",$this -> direccion);
        $sentencia->bindValue(":horarios" ,$this->horarios);
        $sentencia->bindValue(":procedimiento" ,$this->procedimiento);
        //$sentencia->bindValue(":id",$this->id);
        return $sentencia->execute();
    }

    public function modificar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "UPDATE dentista SET  direccion = :direccion ,horarios=:horarios, procedimiento = :procedimiento WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":direccion",$this -> direccion);
        $sentencia->bindValue(":horarios" ,$this->horarios);
        $sentencia->bindValue(":procedimiento" ,$this->procedimiento);
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