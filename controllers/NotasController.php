<?php
namespace App\Controllers;

require __DIR__ . '/../models/Nota.php';

use App\Models\Nota;
use App\Models\Databases\AppNotasDB;

class NotasController
{
    public function queryAllNotas()
    {
        $nota = new Nota();
        return $nota->all();
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

        // Validar que la materia pertenezca al programa del estudiante
        $db = new AppNotasDB();
        $sql = "SELECT COUNT(*) AS valid FROM materias m 
                JOIN estudiantes e ON e.programa = m.programa
                WHERE m.codigo = ? AND e.codigo = ?";
        $result = $db->execSQL($sql, true, "ss", $request['materia'], $request['estudiante']);
        $valid = $result->fetch_assoc()['valid'];
        $db->close();

        if ($valid == 0) {
            return "no_coincide_programa";
        }

        // Registrar nota
        $nota = new Nota($request['materia'], $request['estudiante'], $request['actividad'], $request['nota']);
        return $nota->insert();
    }

    public function updateNota($request)
    {
        if (empty($request['materia']) || empty($request['estudiante']) || empty($request['actividad']) || empty($request['nota'])) {
            return false;
        }

        $nota = new Nota($request['materia'], $request['estudiante'], $request['actividad'], $request['nota']);
        return $nota->update();
    }

    public function deleteNota($request)
    {
        if (empty($request['materia']) || empty($request['estudiante']) || empty($request['actividad'])) {
            return false;
        }

        $nota = new Nota($request['materia'], $request['estudiante'], $request['actividad']);
        return $nota->delete();
    }

    // Calcular el promedio actual de un estudiante en una materia
    public function getPromedio($materia, $estudiante)
    {
        $nota = new Nota($materia, $estudiante);
        return $nota->calcularPromedio();
    }
}
