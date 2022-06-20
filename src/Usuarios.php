<?php

namespace Mattias\Dentista;

class Usuarios{

    private $nombres, $paterno, $materno, $correo, $password, $rol, $id;

    public function __construct( $nombres, $paterno,$materno, $correo, $password, $rol,$id=null){
        $this->id = $id; 
        $this->nombres = $nombres;
        $this->paterno = $paterno; 
        $this->materno = $materno; 
        $this->correo = $correo;
        $this->password = password_hash($password,PASSWORD_DEFAULT);
        $this->rol = $rol;
    }

    // FUNCION PARA INSERTAR
    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO usuarios(id, nombres, paterno, materno, correo, password, rol) VALUE (:id, :nombres, :paterno, :materno, :correo, :password, :rol)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":id",$this->id);
        $sentencia->bindValue(":nombres",$this->nombres);
        $sentencia->bindValue(":paterno",$this->paterno);
        $sentencia->bindValue(":materno",$this->materno);
        $sentencia->bindValue(":correo",$this->correo);
        $sentencia->bindValue(":password",$this->password);
        $sentencia->bindValue(":rol",$this->rol);
        return $sentencia->execute();
    }

    // LISTAR ELEMENTOS DE BD
    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM usuarios";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\usuarios',array(null,null,null,null, null, null, null));
        return $sentencia->fetchAll();
    }

    public static function listarJoin(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT u.id, u.nombres, u.paterno, u.materno, u.correo, u.password, u.rol, r.descripcion FROM usuarios as u INNER JOIN roles as r ON u.rol = r.id";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_OBJ);
        return $sentencia->fetchAll();
    }
    // MODIFICAR 
    public function modificar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "UPDATE usuarios SET nombres = :nombres, paterno = :paterno , materno = :materno , correo = :correo , rol = :rol WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":nombres",$this->nombres);
        $sentencia->bindValue(":paterno",$this->paterno);
        $sentencia->bindValue(":materno",$this->materno);
        $sentencia->bindValue(":correo",$this->correo);
        $sentencia->bindValue(":rol",$this->rol);
        $sentencia->bindValue(":id",$this->id);
        return $sentencia->execute();
    }

    // ELIMINAR 
    public function eliminar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindParam(':id',$this->id);
        return $sentencia->execute();
    }

    public static function getCorreoUsr(Db $db, $correo)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":correo",$correo);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Usuarios',array(null,null,null,null,null,"",null));
        return $sentencia->fetch();
    }
    //poner getters y setters plox

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
     * Get the value of nombre
     */ 
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set the value of nombre
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
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}