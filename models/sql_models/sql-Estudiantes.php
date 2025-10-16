<?php
class SqlEstudiante{

    public static function selectAll(){
        $sql = "select * from estudiantes";
        return $sql;
    }

    public static function selectByCodigo(){
        $sql = "select * from estudiante codigo=?";
        return $sql;
    }

    public static function insertInto(){
        $sql = "insert into estudiantes(codigo, nombre, email, programa)values";
        $sql .= "(?,?,?,?)";
        return $sql;
    }

    public static function update(){
        $sql = "update estudiantes set ";
        $sql.= "codigo=?,";
        $sql.= "nombre=?,";
        $sql.= "email=? where codigo=?";
        $sql.= "programa,";
        return $sql;
    }

    public static function delete(){
        $sql = "delete from estudiantes where codigo=?";
        return $sql;
    }
}