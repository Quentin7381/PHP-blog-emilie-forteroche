<?php

namespace services\DBQuery\components;

class GroupBy extends AbstractQuery implements \ArrayAccess {

    protected array $columns = [];
    
    public function __construct($columns = []) {
        $this->columns = $columns;
    }

    public function toString() {
        return " GROUP BY " . implode(", ", $this->columns);
    }

    public function offsetExists($offset): bool {
        return isset($this->columns[$offset]);
    }

    public function offsetGet($offset): array {
        return $this->columns[$offset];
    }

    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->columns);

        $this->columns[$offset] = $value;
    }

    public function offsetUnset($offset): void {
        unset($this->columns[$offset]);
    }
}