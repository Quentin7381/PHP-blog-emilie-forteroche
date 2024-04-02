<?php

namespace services\DBQuery\components;

class Limit extends AbstractQuery {
    
    protected $limit;

    public function __construct($limit = null) {
        $this->limit = $limit;
    }

    public function toString() {
        return " LIMIT {$this->limit}";
    }

}