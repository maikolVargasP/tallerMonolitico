<?php
namespace App\Controllers;

require_once __DIR__ . "/../models/Programa.php";

use App\Models\Programa;

class ProgramaController
{
    public function queryAllProgramas()
    {
        $programa = new Programa();
        return $programa->all();
    }

    public function saveNewPrograma($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) 
        ) {
            return false;
        }

        $programa = new Programa(
            $request['codigo'],
            $request['nombre'],
        );

        return $programa->insert();
    }

    public function deletePrograma($codigo)
    {
        if (empty($codigo)) {
            return false;
        }

        $programa = new Programa($codigo);

        if ($programa->tieneEstudiantes() || $programa->tieneMaterias()) {
            return "relaciones"; // no se puede eliminar
        }

        return $programa->delete();
    }

    public function updatePrograma($request)
    {
        if (empty($request['codigo']) || empty($request['nombre'])) {
            return false;
        }

        $programa = new Programa($request['codigo'], $request['nombre']);

        // Verificar relaciones
        if ($programa->tieneEstudiantes() || $programa->tieneMaterias()) {
            return "relaciones"; // no se puede modificar
        }

        return $programa->update();
    }
    public function queryProgramaByCodigo($codigo)
{
    $programaModel = new Programa();
    return $programaModel->findByCodigo($codigo);
}

}


