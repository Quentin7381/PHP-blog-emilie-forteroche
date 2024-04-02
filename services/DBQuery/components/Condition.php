<?php

namespace services\DBQuery\components;

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
        return " {$this->column} {$this->operator} {$this->value}";
    }
}