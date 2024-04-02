<?php

namespace services\DBQuery\components;

class OffSet extends AbstractQuery {

    protected $offset;
    public function __construct($offset = null) {
        $this->offset = $offset;
    }
    
    public function toString() {
        return " OFFSET {$this->offset}";
    }
    
}