<?php

namespace services\DBQuery;

class Update extends components\AbstractQuery {
    
    protected ?string $table;
    protected ?components\Set $set;
    protected ?components\Where $where;

    public function __construct($table = null, $set = null, $where = null) {
        $this->table = $table;
        $this->set = new components\Set($set);
        $this->where = new components\Where($where);
    }

    public function toString() {
        $str = "UPDATE $this->table";
        $str .= $this->set->toString();
        $str .= $this->where->toString();
        return $str;
    }

}