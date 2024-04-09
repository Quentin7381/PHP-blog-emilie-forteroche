<?php

namespace Utils\DBQuery\components;

class OffSet extends AbstractQuery {

    protected ?int $offset;
    public function __construct(?int $offset = null) {
        $this->offset = $offset;
    }
    
    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete offset est vide
     */
    public function toString() {
        if(empty($this->offset)){
            throw new \Exception('offset property is required');
        }
        return " OFFSET {$this->offset}";
    }
    
}
