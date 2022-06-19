<?php

namespace Mattias\Dentista; 

class horarios{

private $id, $dias, $horas;

    public function __construct($id, $dias, $horas)
    {
        $this->id = $id; 
        $this->dias = $dias;
        $this->horas = $horas; 
    }

    // FUNCION PARA INSERTAR
    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO horarios(id, dias, horas) VALUE (:id, :dias, :horas)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":id",$this->id);
        $sentencia->bindValue(":dias",$this->dias);
        $sentencia->bindValue(":horas",$this->horas);
        return $sentencia->execute();
    }
    // LISTAR ELEMENTOS DE BD
    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM horarios";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Horarios',array(null,null,null));
        return $sentencia->fetchAll();
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
 * Get the value of dias
 */ 
public function getDias()
{
return $this->dias;
}

/**
 * Set the value of dias
 *
 * @return  self
 */ 
public function setDias($dias)
{
$this->dias = $dias;

return $this;
}

/**
 * Get the value of horas
 */ 
public function getHoras()
{
return $this->horas;
}

    /**
     * Set the value of horas
     *
     * @return  self
     */ 
    public function setHoras($horas)
    {
        $this->horas = $horas;
        return $this;
    }
}



?>