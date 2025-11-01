<?php
namespace App\Models;

require_once __DIR__ . "/sql_models/sql-Nota.php";
require_once __DIR__ . "/sql_models/model.php";
require_once __DIR__ . "/databases/notas-AppDB.php";

use App\Models\SQLModels\SqlNota;
use App\Models\SQLModels\Model;
use App\Models\Databases\AppNotasDB;

class Nota extends Model
{
    public $id;
    public $materia;
    public $estudiante;
    public $actividad;
    public $nota;

    public function __construct($id = null, $materia = null, $estudiante = null, $actividad = null, $nota = null)
    {
        $this->id = $id;
        $this->materia = $materia;
        $this->estudiante = $estudiante;
        $this->actividad = $actividad;
        $this->nota = $nota;
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
        $sql = SqlNota::selectAll();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true);
        $notas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notas[] = new Nota(
                    $row['id'],
                    $row['materia'],
                    $row['estudiante'],
                    $row['actividad'],
                    $row['nota']
                );
            }
        }

        $db->close();
        return $notas;
    }

    public function findById($id)
    {
        $sql = SqlNota::selectById();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true, "i", $id);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db->close();
            return new Nota(
                $row['id'],
                $row['materia'],
                $row['estudiante'],
                $row['actividad'],
                $row['nota']
            );
        }

        $db->close();
        return null;
    }
    public function find()  
    {
        
    }

    public function insert()
    {
        $db = new AppNotasDB();

        // Calcular siguiente ID manualmente
        $result = $db->execSQL("SELECT MAX(id) AS max_id FROM notas", true);
        $row = $result->fetch_assoc();
        $nextId = ($row && $row['max_id']) ? $row['max_id'] + 1 : 1;

        $sql = SqlNota::insertInto();
        $result = $db->execSQL(
            $sql,
            false,
            "isssd",
            $nextId,
            $this->materia,
            $this->estudiante,
            $this->actividad,
            $this->nota
        );

        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = SqlNota::update();
        $db = new AppNotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "sssdi",
            $this->materia,
            $this->estudiante,
            $this->actividad,
            $this->nota,
            $this->id,
        );
        $db->close();
        return $result;
    }

    public function delete()
    {
        $sql = SqlNota::delete();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "i", $this->id);
        $db->close();
        return $result;
    }

    public function calcularPromedio($materia, $estudiante)
    {
        $sql = SqlNota::promedio();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true, "ss", $materia, $estudiante);
        $row = $result->fetch_assoc();
        $db->close();

        return $row['promedio'] ?? 0;
    }
    public function findByEstudiante($codigoEstudiante)
    {
    $sql = "SELECT * FROM notas WHERE estudiante = ?";
    $db = new AppNotasDB();
    $result = $db->execSQL($sql, true, "s", $codigoEstudiante);

    $notas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $notas[] = new Nota(
                $row['id'],
                $row['materia'],
                $row['estudiante'],
                $row['actividad'],
                $row['nota']
            );
        }
    }

    $db->close();
    return $notas;
}

}
