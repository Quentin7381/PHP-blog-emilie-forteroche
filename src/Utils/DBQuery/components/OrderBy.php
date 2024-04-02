<?php

namespace Utils\DBQuery\components;

class OrderBy extends AbstractQuery implements \ArrayAccess{
    
    protected $orderBys = [];

    public function __construct(array $orderBys = []){
        foreach($orderBys as $key => $direction){
            $this->offsetSet($key, $direction);
        }
    }

    public function offsetUnset($offset): void {
        unset($this->orderBys[$offset]);
    }

    public function toString(): string{
        if(empty($this->orderBys)){
            throw new \Exception('orderBys property is required');
        }
        $orderBys = [];
        foreach($this->orderBys as $column => $direction){
            $orderBys[] = " $column $direction";
        }

        return ' ORDER BY' . implode(',', $orderBys);
    }

    public function offsetExists($offset): bool{
        return isset($this->orderBys[$offset]);
    }

    public function offsetGet($offset): array{
        $key = $this->orderBys[$offset];
        $direction = $this->directions[$offset];
        return [$key, $direction];
    }

    public function offsetSet($key, $direction): void {
        if($key === null) $key = count($this->orderBys);

        $this->orderBys[$key] = $direction;
    }
}