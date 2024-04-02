<?php

namespace Utils\DBQuery;
use Utils\DBQuery\components\AbstractQuery;
use Utils\DBQuery\components\Values;

class InsertInto extends AbstractQuery implements \ArrayAccess{
    
    protected $table;
    protected $values = [];

    public function __construct($table = '', $values = []) {
        $this->table = $table;
        $this->set_values($values);
    }

    public function toString() {
        if(empty($this->table) || empty($this->values)){
            throw new \Exception('table and values properties are required');
        }
        $str = "INSERT INTO {$this->table}";
        $str .= $this->values->toString();
        return $str;
    }

    public function offsetExists($offset): bool{
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset): array{
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value): void{
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset): void{
        unset($this->values[$offset]);
    }

    public function set_values($values) {
        if(!$values instanceof Values) {
            $values = new Values($values);
        }
        $this->values = $values;
    }
}