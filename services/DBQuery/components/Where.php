<?php

namespace services\DBQuery\components;

class Where extends AbstractQuery implements \ArrayAccess{
    
    protected array $conditions = [];
    protected array $operators = [];

    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->conditions);
        if(!is_array($value)) $value = [$value];

        $this->conditions[$offset] = $value[0];
        if($offset > 0) {
            $this->operators[$offset] = $value[1] ?? 'AND';
        }
    }

    public function offsetUnset($offset): void {
        unset($this->conditions[$offset]);
        unset($this->operators[$offset-1]);
    }

    public function offsetExists($offset): bool {
        return isset($this->conditions[$offset]);
    }

    public function offsetGet($offset): array {
        return [$this->conditions[$offset], $this->operators[$offset-1] ?? 'AND'];
    }

    public function toString(): string {
        $str = ' WHERE';
        foreach($this->conditions as $key => $condition){
            if(isset($this->operators[$key])) $str .= ' ' . $this->operators[$key];
            $str .= $condition->toString();
        }

        return $str;
    }

    public function __construct(?array $conditions = []){
        foreach($conditions as $key => $condition){
            $this->offsetSet($key, $condition);
        }
    }
}