<?php

namespace services\DBQuery\components;

class Set extends AbstractQuery implements \ArrayAccess{
    protected array $set;

    public function __construct($set = []) {
        $this->set = $set;
    }

    public function toString() {
        $set = [];
        foreach($this->set as $column => $value) {
            $set[] = " $column = $value";
        }
        return ' SET' . implode(',', $set);
    }

    public function offsetExists($column): bool{
        return isset($this->set[$column]);
    }

    public function offsetGet($column): array{
        return $this->set[$column];
    }

    public function offsetSet($column, $value): void{
        $this->set[$column] = $value;
    }
    public function offsetUnset($column): void{
        unset($this->set[$column]);
    }
}