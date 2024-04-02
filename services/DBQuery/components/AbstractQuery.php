<?php

namespace services\DBQuery\components;

abstract class AbstractQuery{

    public function __set($name, $value){
        if(method_exists($this, 'set_'.$name)){
            $this->{'set_'.$name}($value);
            return;
        }
        $this->$name = $value;
    }

    public function __get($name){
        if(method_exists($this, 'get'.$name)){
            return $this->{'get'.$name}();
        }
        return $this->$name;
    }

    public function __toString(){
        return $this->toString();
    }

    abstract public function toString();
    abstract public function __construct();
}