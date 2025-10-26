<?php
namespace App\Models;

require __DIR__ . "/sql_models/sql-Estudiante.php";
require __DIR__ . "/sql_models/model.php";
require __DIR__ . "/databases/notas-AppDB.php";

use App\Models\SQLModels\Model;
use App\Models\SQLModels\SqlEstudiante;
use App\Models\Databases\AppNotasDB;

class Estudiante extends Model
{
    public $codigo;
    public $nombre;
    public $email;
    public $programa;


public function __construct($codigo = null, $nombre = null, $email = null, $programa = null)
{
    $this->codigo = $codigo;
    $this->nombre = $nombre;
    $this->email = $email;
    $this->programa = $programa;
}

    public function get($prop)
    {
        return $this->{$prop};
    }
    public function set($prop, $value)
    {
        $this->{$prop} = $value;
    }
    public function all()
    {
        $sql = SqlEstudiante::selectAll();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true);
        $estudiantes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $estudiante = new Estudiante();
                $estudiante->set('codigo', $row["codigo"]);
                $estudiante->set('nombre', $row["nombre"]);
                $estudiante->set('email', $row["email"]);
                $estudiante->set('programa', $row["programa"]);
                array_push($estudiantes, $estudiante);
            }
        }
        $db->close();
        return $estudiantes;
    }
    public function find()
    {
    }
    public function insert()
    {
        $sql = SqlEstudiante::insertInto();
        $db = new AppNotasDB();

        $result = $db->execSQL(
            $sql,
            false,
            "ssss", // cuatro strings: codigo, nombre, email, programa
            $this->codigo,
            $this->nombre,
            $this->email,
            $this->programa
        );

        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = SqlEstudiante::update();
        $db = new AppNotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "sssi",
            $this->nombre,
            $this->email,
            $this->programa,
            $this->codigo
        );
        $db->close();
        return $result;
    }
    public function delete()
    {
        $sql = SqlEstudiante::delete();
        $db = new AppNotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "i",
            $this->codigo
        );
        $db->close();
        return $result;
    }
}