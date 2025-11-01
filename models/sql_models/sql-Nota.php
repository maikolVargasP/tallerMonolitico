<?php
namespace App\Models\SQLModels;

class SqlNota
{
    public static function selectAll()
    {
        return "SELECT * FROM notas ORDER BY id ASC";
    }

    public static function selectById()
    {
        return "SELECT * FROM notas WHERE id = ?";
    }

    public static function insertInto()
    {
        return "INSERT INTO notas (id, materia, estudiante, actividad, nota) VALUES (?, ?, ?, ?, ?)";
    }

    public static function update()
    {
        return "UPDATE notas SET materia = ?, estudiante = ?, actividad = ?, nota = ? WHERE id = ?";
    }

    public static function delete()
    {
        return "DELETE FROM notas WHERE id = ?";
    }

    public static function promedio()
    {
        return "SELECT ROUND(AVG(nota), 2) AS promedio FROM notas WHERE materia = ? AND estudiante = ?";
    }
}
