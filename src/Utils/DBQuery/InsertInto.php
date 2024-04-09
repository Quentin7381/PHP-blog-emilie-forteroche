<?php

namespace Utils\DBQuery;
use Utils\DBQuery\components\AbstractQuery;
use Utils\DBQuery\components\Values;

/**
 * Requete SQL INSERT INTO
 *
 * --- Utilisation
 * $insert->table = 'table_name';
 * $insert->values[] = ['column_name' => 'value', 'column_name' => 'value'];
 * $insert->values[2]['column_name'] = 'value';
 */
class InsertInto extends AbstractQuery implements \ArrayAccess{
    
    protected ?string $table;
    protected ?Values $values = null;

    /**
     * Constructeur
     *
     * @param string $table Nom de la table
     * @param array $values Valeurs à insérer
     */
    public function __construct(?string $table = '', array $values = []) {
        $this->table = $table;
        $this->set_values($values);
    }

    /**
     * @return string Requête SQL
     * @throws \Exception Si les propriétés table et values sont vides
     */
    public function toString() {
        if(empty($this->table) || empty($this->values)){
            throw new \Exception('table and values properties are required');
        }
        $str = "INSERT INTO {$this->table}";
        $str .= $this->values->toString();
        return $str;
    }

    // ----- ARRAY ACCESS -----

    public function offsetExists($offset): bool{
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset): array{
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value): void{
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset): void{
        unset($this->values[$offset]);
    }

    // ----- SETTERS -----

    /**
     * Setter de la propriété values
     * Automatiquement appelé via la methode __set
     *
     * @see Values::__construct pour le format des valeurs
     *
     * @param string $table Nom de la table
     */
    public function set_values(array|Values $values) {
        if(!$values instanceof Values) {
            $values = new Values($values);
        }
        $this->values = $values;
    }
}
