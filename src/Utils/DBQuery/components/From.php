<?php

namespace Utils\DBQuery\components;

/**
 * From SQL
 *
 * Agregation d'une table source
 */
class From extends AbstractQuery{

    protected ?string $from;

    /**
     * Constructeur
     *
     * @var string $from Table source
     */
    public function __construct(?string $from = null){
        $this->from = $from;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete from est vide
     */
    public function toString(){
        if(empty($this->from)){
            throw new \Exception('from property is required');
        }
        return " FROM {$this->from}";
    }

}
