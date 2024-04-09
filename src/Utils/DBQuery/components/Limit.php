<?php

namespace Utils\DBQuery\components;

/**
 * Limit SQL
 *
 * Limite le nombre de resultats
 */
class Limit extends AbstractQuery {
    
    protected ?int $limit;

    public function __construct(?int $limit = null) {
        $this->limit = $limit;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete limit est vide
     */
    public function toString() {
        if(empty($this->limit)){
            throw new \Exception('limit property is required');
        }
        return " LIMIT {$this->limit}";
    }
}
