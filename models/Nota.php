<?php
namespace App\Models;

require __DIR__ . "/databases/notas-AppDB.php";

use App\Models\Databases\AppNotasDB;

class Nota
{
    public $materia;
    public $estudiante;
    public $actividad;
    public $nota;

    public function __construct($materia = null, $estudiante = null, $actividad = null, $nota = null)
    {
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
        $sql = "SELECT * FROM notas";
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true);
        $notas = [];

        while ($row = $result->fetch_assoc()) {
            $notas[] = new Nota($row['materia'], $row['estudiante'], $row['actividad'], $row['nota']);
        }

        $db->close();
        return $notas;
    }

    public function insert()
    {
        $sql = "INSERT INTO notas (materia, estudiante, actividad, nota) VALUES (?, ?, ?, ?)";
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "sssd", $this->materia, $this->estudiante, $this->actividad, $this->nota);
        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE notas SET nota = ? WHERE materia = ? AND estudiante = ? AND actividad = ?";
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "dsss", $this->nota, $this->materia, $this->estudiante, $this->actividad);
        $db->close();
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM notas WHERE materia = ? AND estudiante = ? AND actividad = ?";
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, false, "sss", $this->materia, $this->estudiante, $this->actividad);
        $db->close();
        return $result;
    }

    // Calcula el promedio de notas por estudiante y materia
    public function calcularPromedio()
    {
        $sql = "SELECT ROUND(AVG(nota), 2) AS promedio FROM notas WHERE materia = ? AND estudiante = ?";
        $db = new AppNotasDB();
        $result = $db->execSQL($sql, true, "ss", $this->materia, $this->estudiante);
        $row = $result->fetch_assoc();
        $db->close();

        return $row['promedio'] ?? 0;
    }
}
