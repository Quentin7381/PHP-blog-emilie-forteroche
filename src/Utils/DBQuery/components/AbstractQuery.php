<?php

namespace Utils\DBQuery\components;

abstract class AbstractQuery{

    protected $objectPlaceholders = [];

    public function __set($name, $value){
        if(method_exists($this, 'set_'.$name)){
            $this->{'set_'.$name}($value);
            return;
        }
        if(in_array($name, $this->objectPlaceholders)){
            $class = $this->getClassName($name);
            if(empty($value)){
                $this->$name = null;
                return;
            }
            if(!$value instanceof $class){
                $value = new $class($value);
            }
            $this->$name = $value;
            return;
        }

        $this->$name = $value;
    }

    public function __get($name){
        if(method_exists($this, 'get'.$name)){
            return $this->{'get'.$name}();
        }
        if(in_array($name, $this->objectPlaceholders)){
            if(!isset($this->$name)){
                $class = $this->getClassName($name);
                $this->$name = new $class();
            }
            return $this->$name;
        }
        return $this->$name;
    }

    public function getClassName($key){
        $key = ucfirst($key);
        return 'Utils\DBQuery\components\\'.$key;
    }

    public function __toString(){
        return $this->toString();
    }

    abstract public function toString();
    abstract public function __construct();
}