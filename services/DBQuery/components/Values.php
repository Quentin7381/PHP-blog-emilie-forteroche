<?php

namespace services\DBQuery\components;

class Values extends AbstractQuery implements \ArrayAccess {
    
    protected $columns = [];
    protected $rows = [];

    public function __construct($columns = [], $rows = []) {
        $this->columns = $columns;
        $this->rows = $rows;
    }

    public function offsetExists($offset): bool{
        return isset($this->rows[$offset]);
    }

    public function offsetGet($offset): Row{
        if(!isset($this->rows[$offset])) $this->rows[$offset] = new Row($this->columns);
        return $this->rows[$offset];
    }

    public function offsetSet($offset, $row): void{
        if($offset === null) $offset = count($this->rows);

        if(!$row instanceof Row){
            $row = new Row($this->columns, $row);
        }

        $this->rows[$offset] = $row;
    }

    public function offsetUnset($offset): void{
        unset($this->rows[$offset]);
    }

    public function toString(): string{
        $rows = [];
        foreach($this->rows as $row){
            $rows[] = $row->toString();
        }

        return ' (' . implode(', ', $this->columns) . ') VALUES' . implode(',', $rows);
    }
}