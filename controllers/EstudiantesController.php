<?php
namespace App\Controllers;

require_once __DIR__ . "/../models/Estudiante.php";

use App\Models\Estudiante;

class EstudiantesController
{
    public function queryAllEstudiantes()
    {
        $estudiante = new Estudiante();
        return $estudiante->all();
    }

    public function saveNewEstudiante($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['email']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $estudiante = new Estudiante(
            $request['codigo'],
            $request['nombre'],
            $request['email'],
            $request['programa']
        );

        return $estudiante->insert();
    }

    public function deleteEstudiante($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }

        $estudiante = new Estudiante($request['codigo']);

        // No se puede eliminar si tiene notas
        if ($estudiante->tieneNotas()) {
            return "notas";
        }

        return $estudiante->delete();
    }


    public function updateEstudiante($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['email']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $estudiante = new Estudiante(
            $request['codigo'],
            $request['nombre'],
            $request['email'],
            $request['programa']
        );

        // No se puede modificar si tiene notas registradas
        if ($estudiante->tieneNotas()) {
            return "notas";
        }

        return $estudiante->update();
    }
    public function queryEstudianteByCodigo($codigo)
{
    $estudianteModel = new Estudiante();
    return $estudianteModel->findByCodigo($codigo);
}


}
