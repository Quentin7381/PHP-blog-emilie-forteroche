<?php

namespace services\DBQuery\components;

class From extends AbstractQuery{

    protected $from;

    public function __construct($from = null){
        $this->from = $from;
    }

    public function toString(){
        if(empty($this->from)){
            throw new \Exception('from property is required');
        }
        return " FROM {$this->from}";
    }

}