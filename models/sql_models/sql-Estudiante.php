<?php
namespace App\Models\SQLModels;

class SqlEstudiante
{
    public static function selectAll()
    {
        return "SELECT * FROM estudiantes";
    }

    public static function selectByCodigo()
    {
        return "SELECT * FROM estudiantes WHERE codigo = ?";
    }

    public static function insertInto()
    {
        // Incluye el campo 'codigo' porque será ingresado manualmente
        return "INSERT INTO estudiantes (codigo, nombre, email, programa) VALUES (?, ?, ?, ?)";
    }

    public static function update()
    {
        // Actualiza por código
        return "UPDATE estudiantes SET nombre = ?, email = ?, programa = ? WHERE codigo = ?";
    }

    public static function delete()
    {
        return "DELETE FROM estudiantes WHERE codigo = ?";
    }
}
