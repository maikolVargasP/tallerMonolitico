<?php
namespace App\Controllers;

require __DIR__ . "/../models/Materia.php";

use App\Models\Materia;

class MateriasController
{
    public function queryAllMaterias()
    {
        $materia = new Materia();
        return $materia->all();
    }

    public function saveNewMateria($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $materia = new Materia(
            $request['codigo'],
            $request['nombre'],
            $request['programa']
        );

        return $materia->insert();
    }

    public function deleteMateria($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }

        $materia = new Materia($request['codigo']);

        // Verificar si tiene notas
        if ($materia->tieneNotas()) {
            return "notas"; // No se puede eliminar si tiene notas
        }

        return $materia->delete();
    }

    public function updateMateria($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $materia = new Materia(
            $request['codigo'],
            $request['nombre'],
            $request['programa']
        );

        // Verificar si tiene notas
        if ($materia->tieneNotas()) {
            return "notas"; // No se puede modificar si tiene notas registradas
        }

        return $materia->update();
    }
}
