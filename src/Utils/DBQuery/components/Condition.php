<?php

namespace Utils\DBQuery\components;

class Condition extends AbstractQuery {
    
    protected $column;
    protected $operator;
    protected $value;

    public function __construct($column = null, $value = null, $operator = '=') {
        $this->column = $column;
        $this->value = $value;
        $this->operator = $operator;
    }

    public function toString() {
        if(empty($this->column) || empty($this->value)){
            throw new \Exception('column and value properties are required');
        }
        return " {$this->column} {$this->operator} {$this->value}";
    }
}