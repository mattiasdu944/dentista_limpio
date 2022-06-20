<?php 
namespace Mattias\Dentista;
class Paciente
{
    private $ci, $nombres,$paterno,$materno,$correo,$telefono,$edad;
    public function __construct($ci, $nombres,$paterno,$materno,$correo,$telefono,$edad)
    {
        $this->ci = $ci;
        $this->nombres = $nombres;
        $this->paterno = $paterno;
        $this->materno = $materno; 
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->edad = $edad;
        
    }
    public static function listar(Db $db){
        $c = $db->getConexion();
        $sql = "SELECT * FROM pacientes ORDER BY paterno"; 
        $sentecia = $c->prepare($sql);
        $sentecia->execute();
        $sentecia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Paciente',array(null,null,null,null,null,null,null));
        return $sentecia->fetchAll();

    }
    public function insertar(Db $db){
        $c = $db->getConexion();
        $sql = "INSERT INTO pacientes (ci,nombres,paterno,materno,correo,telefono,edad) VALUES (:ci,:nombres,:paterno,:materno,:correo,:telefono,:edad)";
        $sentecia = $c->prepare($sql);
        $sentecia->bindParam(':ci',$this->ci);
        $sentecia->bindParam(':nombres',$this->nombres);
        $sentecia->bindParam(':paterno',$this->paterno);
        $sentecia->bindParam(':materno',$this->materno);
        $sentecia->bindParam(':correo',$this->correo);
        $sentecia->bindParam(':telefono',$this->telefono);
        $sentecia->bindParam(':edad',$this->edad);
        return $sentecia->execute();
    }
    public function modificar(Db $db){
        $c = $db->getConexion();
        $sql = "UPDATE pacientes SET nombres=:nombres,paterno=:paterno,materno=:materno,correo=:correo,telefono=:telefono,edad=:edad WHERE ci=:ci";
        $sentecia = $c->prepare($sql);
        $sentecia->bindParam(':ci',$this->ci);
        $sentecia->bindParam(':nombres',$this->nombres);
        $sentecia->bindParam(':paterno',$this->paterno);
        $sentecia->bindParam(':materno',$this->materno);
        $sentecia->bindParam(':correo',$this->correo);
        $sentecia->bindParam(':telefono',$this->telefono);
        $sentecia->bindParam(':edad',$this->edad);
        return $sentecia->execute();
        
        
    }

    public function eliminar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "DELETE FROM pacientes WHERE ci = :ci";
        $sentencia = $c->prepare($sql);
        $sentencia->bindParam(':ci',$this->ci);
        return $sentencia->execute();
    }
    

    /**
     * Get the value of ci
     */ 
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set the value of ci
     *
     * @return  self
     */ 
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get the value of nombres
     */ 
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set the value of nombres
     *
     * @return  self
     */ 
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get the value of paterno
     */ 
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set the value of paterno
     *
     * @return  self
     */ 
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get the value of materno
     */ 
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set the value of materno
     *
     * @return  self
     */ 
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of edad
     */ 
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }
}


?>