<?php

namespace Utils\DBQuery\components;

class Limit extends AbstractQuery {
    
    protected $limit;

    public function __construct($limit = null) {
        $this->limit = $limit;
    }

    public function toString() {
        if(empty($this->limit)){
            throw new \Exception('limit property is required');
        }
        return " LIMIT {$this->limit}";
    }

}