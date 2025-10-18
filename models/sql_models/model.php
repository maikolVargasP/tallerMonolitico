<?php
namespace App\Models\SQLModels;

abstract class Model
{
    abstract public function find($codigo);
    abstract public function insert($data);
    abstract public function update($codigo, $data);
    abstract public function delete($codigo);
}
echo __DIR__ ."";