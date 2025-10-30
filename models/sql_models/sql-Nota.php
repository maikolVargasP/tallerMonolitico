<?php
namespace App\Models\SQLModels;

class SqlNota
{
    public static function selectAll()
    {
        return "SELECT * FROM notas";
    }

    public static function selectByEstudiante()
    {
        return "SELECT * FROM notas WHERE estudiante = ?";
    }

    public static function insertInto()
    {
        return "INSERT INTO notas (materia, estudiante, actividad, nota) VALUES (?, ?, ?, ?)";
    }

    public static function update()
    {
        return "UPDATE notas SET materia = ?, estudiante = ?, actividad = ?, nota = ? WHERE materia = ? AND estudiante = ? AND actividad = ?";
    }

    public static function delete()
    {
        return "DELETE FROM notas WHERE materia = ? AND estudiante = ? AND actividad = ?";
    }
}
?>
