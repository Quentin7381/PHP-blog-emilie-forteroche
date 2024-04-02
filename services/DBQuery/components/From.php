<?php

namespace services\DBQuery\components;

class From extends AbstractQuery{

    protected $from;

    public function __construct($from = null){
        $this->from = $from;
    }

    public function toString(){
        return " FROM {$this->from}";
    }

}