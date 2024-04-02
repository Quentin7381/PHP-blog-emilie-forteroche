<?php

namespace services\DBQuery;
use services\DBQuery\components\AbstractQuery;
use services\DBQuery\components\From;
use services\DBQuery\components\Where;

class Delete extends AbstractQuery {
    protected From $from;
    protected Where $where;

    public function __construct($from = '', $where = []) {
        $this->set_from($from);
        $this->set_where($where);
    }
    
    public function toString() {
        $query = "DELETE";
        $query .= $this->from->toString();
        if ($this->where) {
            $query .= $this->where->toString();
        }
        return $query;
    }

    public function set_from($from) {
        if(!$from instanceof From) {
            $from = new From($from);
        }
        $this->from = $from;
    }

    public function set_where($where) {
        if(!$where instanceof Where) {
            $where = new Where($where);
        }
        $this->where = $where;
    }
}