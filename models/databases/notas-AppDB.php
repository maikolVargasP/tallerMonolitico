<?php

class Notas_AppDB
{
    private $hostDb = "localhost";
    private $userDb = "root";
    private $pwdDb = "";
    private $nameDb = "notas_app";
    private $conexDb = null;

    public function __construct()
    {
        $this->conexDb = new mysqli(
            $this->hostDb,
            $this->userDb,
            $this->pwdDb,
            $this->nameDb
        );
        if ($this->conexDb->connect_error) {
            die("Error DB: " . $this->conexDb->connect_error);
        }
    }
    public function close()
    {
        $this->conexDb->close();
    }

    public function execSQL($sql, $isSelect, ...$bindParam = null)
    {
        $prepare = $this->conexDb->prepare($sql);
        if (!empty($bindParam)) {
            $prepare->bind_param(...$bindParam);
        }
        if ($isSelect) {
            $prepare->execute();
            return $prepare->get_result();
        } else {
            return $prepare->execute();
        }
    }
}