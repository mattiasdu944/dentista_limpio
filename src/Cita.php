<?php 
namespace Mattias\Dentista;

class Cita
{
    private $fecha,$hora_atencion,$paciente, $consultorio,$procedimiento, $id;
    public function __construct( $fecha,$hora_atencion,$paciente, $consultorio,$procedimiento,$id=null)
    {
        $this->id = $id; 
        $this->fecha = $fecha;
        $this->hora_atencion = $hora_atencion;
        $this->paciente = $paciente;
        $this->consultorio = $consultorio;
        $this->procedimiento = $procedimiento;
    }

    // FUNCION PARA INSERTAR
    public function insertar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "INSERT INTO citas(id, fecha, hora_atencion, paciente, consultorio, procedimiento) VALUE (:id, :fecha, :hora_atencion, :paciente, :consultorio, :procedimiento)";
        $sentencia = $c->prepare($sql);
        $sentencia->bindValue(":id",$this->id);
        $sentencia->bindValue(":fecha",$this->fecha);
        $sentencia->bindValue(":hora_atencion",$this->hora_atencion);
        $sentencia->bindValue(":paciente",$this->paciente);
        $sentencia->bindValue(":consultorio",$this->consultorio);
        $sentencia->bindValue(":procedimiento",$this->procedimiento);
        return $sentencia->execute();
    }

    public static function listar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT * FROM citas";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'Mattias\Dentista\Cita',array(null,null,null,null,null));
        return $sentencia->fetchAll(); 
    }

    public static function listarJoin(Db $db)
    {
        $c = $db->getConexion();
        $sql = "SELECT c.id ,c.fecha, c.hora_atencion, c.paciente, c.consultorio, c.procedimiento, 
                p.nombres, p.paterno , p.materno, p.telefono, 
                co.direccion, pro.tipo_procedimiento
                FROM citas as c INNER JOIN pacientes as p  ON c.paciente = p.ci 
                INNER JOIN consultorio as co ON c.consultorio = co.id 
                INNER JOIN procedimiento as pro ON c.procedimiento = pro.id";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->setFetchMode(\PDO::FETCH_OBJ);
        return $sentencia->fetchAll();
    }

    public function eliminar(Db $db)
    {
        $c = $db->getConexion();
        $sql = "DELETE FROM citas WHERE id = :id";
        $sentencia = $c->prepare($sql);
        $sentencia->bindParam(':id',$this->id);
        return $sentencia->execute();
    }
    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora_atencion
     */ 
    public function getHora_atencion()
    {
        return $this->hora_atencion;
    }

    /**
     * Set the value of hora_atencion
     *
     * @return  self
     */ 
    public function setHora_atencion($hora_atencion)
    {
        $this->hora_atencion = $hora_atencion;

        return $this;
    }

    /**
     * Get the value of paciente
     */ 
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set the value of paciente
     *
     * @return  self
     */ 
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get the value of consultorio
     */ 
    public function getConsultorio()
    {
        return $this->consultorio;
    }

    /**
     * Set the value of consultorio
     *
     * @return  self
     */ 
    public function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;

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