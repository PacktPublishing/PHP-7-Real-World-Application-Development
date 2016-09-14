<?php
namespace Application\Generic;
// shows the use of private to define a singleton class

class Registry
{
    protected $instance = NULL;
    protected $registry = array();
    private function __construct()
    {
        // nobody can create an instance of this class
    }
    public static function getInstance()
    {
        if (!$this->instance) {
            $this->instance = new self();
        }
        return $this->instance;
    }
    public function __get($key)
    {
        return $this->registry[$key] ?? NULL;
    }
    public function __set($key, $value)
    {
        $this->registry[$key] = $value;
    }
}
