<?php
namespace App\Models\SQLModels;

class SqlPrograma
{
    public static function selectAll()
    {
        return "SELECT * FROM programas";
    }

    public static function selectByCodigo()
    {
        return "SELECT * FROM programas WHERE codigo = ?";
    }

    public static function insertInto()
    {
        // Incluye el campo 'codigo' porque será ingresado manualmente
        return "INSERT INTO programas (codigo, nombre) VALUES (?, ?, ?, ?)";
    }

    public static function update()
    {
        // Actualiza por código
        return "UPDATE programas SET nombre = ?, WHERE codigo = ?";
    }

    public static function delete()
    {
        return "DELETE FROM programas WHERE codigo = ?";
    }
}