<?php

namespace Utils\DBQuery;

class Update extends components\AbstractQuery {
    
    protected ?string $table;
    protected ?components\Set $set;
    protected ?components\Where $where;

    public function __construct($table = null, $set = [], $where = []) {
        $this->table = $table;
        $this->set = new components\Set($set);
        $this->where = new components\Where($where);
    }

    public function toString() {
        if(empty($this->table) || empty($this->set) || empty($this->where)){
            throw new \Exception('table, set and where properties are required');
        }

        $str = "UPDATE $this->table";
        $str .= $this->set->toString();
        $str .= $this->where->toString();
        return $str;
    }

}