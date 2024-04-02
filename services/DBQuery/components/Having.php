<?php

namespace services\DBQuery\components;

class Having extends AbstractQuery implements \ArrayAccess{
    
    protected $conditions = [];
    protected $junctions = [];

    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->conditions);

        if(!is_array($value)) $value = [$value];

        $this->conditions[$offset] = $value[0];
        if($offset > 0) {
            $this->junctions[$offset] = $value[1] ?? 'AND';
        }
    }

    public function offsetUnset($offset): void {
        unset($this->conditions[$offset]);
        unset($this->junctions[$offset-1]);
    }

    public function offsetExists($offset): bool {
        return isset($this->conditions[$offset]);
    }

    public function offsetGet($offset): array {
        return [$this->conditions[$offset], $this->junctions[$offset-1] ?? 'AND'];
    }

    public function toString(): string {
        if(empty($this->conditions)){
            throw new \Exception('conditions property is required');
        }
        $str = ' HAVING';
        foreach($this->conditions as $key => $condition){
            if(isset($this->junctions[$key])){
                $str .= " {$this->junctions[$key]}";
            }

            $str .= $condition->toString();
        }

        return $str;
    }

    public function __construct(array $conditions = []){
        foreach($conditions as $key => $condition){
            $this->offsetSet($key, $condition);
        }
    }
}