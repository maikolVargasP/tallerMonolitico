<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Nota.php';

use App\Models\Nota;

class NotasController
{
    public function queryAllNotas()
    {
        $nota = new Nota();
        return $nota->all();
    }

    public function queryNotaById($id)
    {
        $nota = new Nota();
        return $nota->findById($id);
    }

    public function saveNewNota($request)
    {
        if (
            empty($request['materia']) ||
            empty($request['estudiante']) ||
            empty($request['actividad']) ||
            empty($request['nota'])
        ) {
            return false;
        }

        $nota = new Nota(
            null,
            $request['materia'],
            $request['estudiante'],
            $request['actividad'],
            $request['nota']
        );

        return $nota->insert();
    }

    public function updateNota($request)
{
    if (empty($request['id']) || empty($request['nota'])) {
        return false;
    }

    
    $notaExistente = $this->queryNotaById($request['id']);
    if (!$notaExistente) {
        return false;
    }

    
    $nota = new Nota(
        $request['id'],
        $notaExistente->get('materia'),
        $notaExistente->get('estudiante'),
        $notaExistente->get('actividad'),
        $request['nota']
    );

    return $nota->update();
}


    public function deleteNota($id)
    {
        if (empty($id)) {
            return false;
        }

        $nota = new Nota($id);
        return $nota->delete();
    }

    public function getPromedio($materia, $estudiante)
    {
        $nota = new Nota();
        return $nota->calcularPromedio($materia, $estudiante);
    }
    public function queryNotasByEstudiante($codigoEstudiante)
{
    $notaModel = new Nota();
    return $notaModel->findByEstudiante($codigoEstudiante);
}

}
