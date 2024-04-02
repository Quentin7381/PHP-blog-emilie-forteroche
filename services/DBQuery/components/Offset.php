<?php

namespace services\DBQuery\components;

class OffSet extends AbstractQuery {

    protected $offset;
    public function __construct($offset = null) {
        $this->offset = $offset;
    }
    
    public function toString() {
        if(empty($this->offset)){
            throw new \Exception('offset property is required');
        }
        return " OFFSET {$this->offset}";
    }
    
}