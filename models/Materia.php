<?php
namespace App\Models;

require_once __DIR__ . "/sql_models/sql-materia.php";
require_once __DIR__ . "/databases/notas-AppDB.php";
require_once __DIR__ . "/sql_models/model.php";

use App\Models\SQLModels\SqlMateria;
use App\Models\Databases\AppNotasDB;
use App\Models\SQLModels\Model;


class Materia extends Model
{
    public $codigo;
    public $nombre;
    public $programa;

    public function __construct($codigo = null, $nombre = null, $programa = null)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
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
        $sql = SqlMateria::selectAll();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true);
        $materias = [];

        while ($row = $result->fetch_assoc()) {
            $materia = new Materia($row['codigo'], $row['nombre'], $row['programa']);
            $materias[] = $materia;
        }

        $db->close();
        return $materias;
    }
    public function find()
    {
        $sql = SqlMateria::selectByCodigo();
        $db = new AppNotasDB();


        $result = $db->execSQL($sql, true, "s", $this->codigo);

        $materia = null;
        if ($row = $result->fetch_assoc()) {
            $materia = new Materia(
                $row['codigo'],
                $row['nombre'],
                $row['programa']
            );
        }

        $db->close();
        return $materia;
    }

    public function insert()
    {
        $sql = SqlMateria::insertInto();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "sss", $this->codigo, $this->nombre, $this->programa);
        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = SqlMateria::update();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "sss", $this->nombre, $this->programa, $this->codigo);
        $db->close();
        return $result;
    }

    public function delete()
    {
        $sql = SqlMateria::delete();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "s", $this->codigo);
        $db->close();
        return $result;
    }

    public function tieneNotas()
    {
        $sql = SqlMateria::tieneNotas();
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true, "s", $this->codigo);
        $row = $result->fetch_assoc();
        $db->close();
        return $row['total'] > 0;
    }
    public function findByCodigo($codigo)
    {
        $db = new AppNotasDB();
        $query = SqlMateria::selectByCodigo();
        $result = $db->execSQL($query, true, "s", $codigo);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new self(
                $row['codigo'],
                $row['nombre'],
                $row['programa']
            );
        }

        $db->close();
        return null;
    }

}



