<?php
namespace App\Controllers;

require __DIR__ . "/../models/Estudiante.php";

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

        $estudiante = new Estudiante(
            $request['codigo'],
            '',
            '',
            ''
        );

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

        return $estudiante->update();
    }
}
