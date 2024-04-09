<?php

namespace Utils\DBQuery\components;

/**
 * Condition SQL
 *
 * Agregation d'une colonne cible, d'un operateur et d'une valeur
 */
class Condition extends AbstractQuery {
    protected ?string $column;
    protected ?string $operator;
    protected ?string $value;

    /**
     * Constructeur
     *
     * @param string $column Colonne cible
     * @param mixed $value Valeur
     * @param string $operator Operateur de comparaison
     */
    public function __construct(?string $column = null, ?string $value = null, ?string $operator = '=') {
        $this->column = $column;
        $this->value = $value;
        $this->operator = $operator;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si les proprietes column et value sont vides
     */
    public function toString() {
        if(empty($this->column) || empty($this->value)){
            throw new \Exception('column and value properties are required');
        }
        return " {$this->column} {$this->operator} {$this->value}";
    }
}
