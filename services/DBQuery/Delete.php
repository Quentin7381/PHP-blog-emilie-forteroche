<?php

namespace services\DBQuery;
use services\DBQuery\components\AbstractQuery;
use services\DBQuery\components\From;
use services\DBQuery\components\Where;

class Delete extends AbstractQuery {
    protected $objectPlaceholders = [
        'from',
        'where'
    ];
    protected $from;
    protected $where;

    public function __construct($from = '', $where = []) {
        if(!empty($from)){
            $this->__set('from', $from);
        }
        if(!empty($where)){
            $this->__set('where', $where);
        }
    }
    
    public function toString() {
        if(empty($this->from)){
            throw new \Exception('from property is required');
        }

        $query = "DELETE";
        $query .= $this->from->toString();
        if ($this->where) {
            $query .= $this->where->toString();
        }
        return $query;
    }
}