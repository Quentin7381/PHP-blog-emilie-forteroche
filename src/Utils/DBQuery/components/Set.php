<?php

namespace Utils\DBQuery\components;

/**
 * Set SQL
 *
 * Agregation d'une colonne cible et d'une valeur
 */
class Set extends AbstractQuery implements \ArrayAccess{
    protected array $set = [];

    public function __construct(array $set = []) {
        $this->set = $set;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete set est vide
     */
    public function toString() {
        if(empty($this->set)){
            throw new \Exception('set properties are required');
        }

        $set = [];
        foreach($this->set as $column => $value) {
            $set[] = " $column = $value";
        }
        return ' SET' . implode(',', $set);
    }

    public function offsetExists($column): bool{
        return isset($this->set[$column]);
    }

    public function offsetGet($column): array{
        return $this->set[$column];
    }

    public function offsetSet($column, $value): void{
        $this->set[$column] = $value;
    }
    public function offsetUnset($column): void{
        unset($this->set[$column]);
    }
}
