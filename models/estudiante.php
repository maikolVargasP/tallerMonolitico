<?php
class Estudiante
{
    public $code;
    public $name;
    public $email;
    public $programm;


    public function __construct($code, $name, $email, $programm)
    {
        $this->code = $code;
        $this->name = $name;
        $this->email = $email;
        $this->programm = $programm;
    }
    public function get($prop)
    {
        return $this->{$prop};
    }
    public function set($prop, $value)
    {
        $this->{$prop} = $value;
    }
}