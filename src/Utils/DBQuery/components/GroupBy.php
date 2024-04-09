<?php

namespace Utils\DBQuery\components;

/**
 * Group By SQL
 *
 * Liste de group by
 */
class GroupBy extends AbstractQuery implements \ArrayAccess {

    protected array $columns = [];
    
    /**
     * Constructeur
     *
     * @param array $columns Liste des colonnes
     */
    public function __construct(array $columns = []) {
        $this->columns = $columns;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete columns est vide
     */
    public function toString() {
        if(empty($this->columns)){
            throw new \Exception('columns property is required');
        }
        return " GROUP BY " . implode(", ", $this->columns);
    }

    public function offsetExists($offset): bool {
        return isset($this->columns[$offset]);
    }

    public function offsetGet($offset): array {
        return $this->columns[$offset];
    }

    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->columns);

        $this->columns[$offset] = $value;
    }

    public function offsetUnset($offset): void {
        unset($this->columns[$offset]);
    }
}
