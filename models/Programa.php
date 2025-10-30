<?php
namespace App\Models;

require __DIR__ . "/sql_models/sql-Programa.php";
require __DIR__ . "/sql_models/model.php";
require __DIR__ . "/databases/notas-AppDB.php";

use App\Models\SQLModels\Model;
use App\Models\SQLModels\SqlPrograma;
use App\Models\Databases\AppNotasDB;

class Programa extends Model
{
    public $codigo;
    public $nombre;
    


public function __construct($codigo = null, $nombre = null)
{
    $this->codigo = $codigo;
    $this->nombre = $nombre;
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
        $sql = SqlPrograma::selectAll();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true);
        $programas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $programa = new Programa();
                $programa->set('codigo', $row["codigo"]);
                $programa->set('nombre', $row["nombre"]);
                array_push($programas, $programa);
            }
        }
        $db->close();
        return $programas;
    }
    public function find()
    {
        
    }
    public function insert()
    {
        $sql = SqlPrograma::insertInto();
        $db = new AppNotasDB();

        $result = $db->execSQL(
            $sql,
            false,
            "ss", // dos strings: codigo, nombre
            $this->codigo,
            $this->nombre,
        );

        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = SqlPrograma::update();
        $db = new AppNotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "ss",
            $this->nombre,
            $this->codigo
        );
        $db->close();
        return $result;
    }
    public function delete()
    {
        $sql = SqlPrograma::delete();
        $db = new AppNotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "s",
            $this->codigo
        );
        $db->close();
        return $result;
    }

    
    public function tieneEstudiantes()
    {
        $db = new AppNotasDB();
        $sql = "SELECT COUNT(*) AS total FROM estudiantes WHERE programa = ?";
        $result = $db->execSQL($sql, true, "s", $this->codigo);
        $row = $result->fetch_assoc();
        $db->close();
        return $row['total'] > 0;
    }

    public function tieneMaterias()
    {
        $db = new AppNotasDB();
        $sql = "SELECT COUNT(*) AS total FROM materias WHERE programa = ?";
        $result = $db->execSQL($sql, true, "s", $this->codigo);
        $row = $result->fetch_assoc();
        $db->close();
        return $row['total'] > 0;
    }
    
}