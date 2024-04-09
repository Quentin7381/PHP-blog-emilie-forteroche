<?php

namespace Utils\DBQuery\components;

/**
 * Ligne SQL (pour insertion)
 *
 * Agregation d'une liste de colonnes et d'une liste de valeurs
 */
class Row extends AbstractQuery implements \ArrayAccess{

    protected array $columns = [];
    protected array $row = [];

    /**
     * Constructeur
     *
     * @param array $columns Liste des noms de colonnes
     * @param array $row Liste des valeurs
     */
    public function __construct(array $columns = [], array $row = []){
        $this->columns = $columns;

        $this->set_row($row);
    }

    /**
     * Setter pour la propriete row
     * Reordonne les valeurs en fonction de l'ordre des colonnes
     */
    public function set_row(array $row){
        $row = $this->reorder($row);
        $this->row = $row;
    }

    public function offsetUnset($column): void {
        $key = array_search($column, $this->columns);
        unset($this->row[$key]);
    }

    public function offsetExists($column): bool{
        $key = array_search($column, $this->columns);
        if($key === false) return false;
        return isset($this->row[$key]);
    }

    public function offsetGet($column): mixed{
        $key = array_search($column, $this->columns);
        return $this->row[$key];
    }

    public function offsetSet($column, $value): void{
        $key = array_search($column, $this->columns);
        if($key === false) $key = count($this->columns);

        $this->row[$key] = $value;
    }

    /**
     * Reorganise les cles du tableau $row pour correspondre a l'ordre des colonnes
     */
    protected function reorder(array $row): array{
        $newRow = [];
        foreach($row as $key => $value){
            $newKey = array_search($key, $this->columns);
            if($newKey === false) $newKey = $key;
            $newRow[$newKey] = $value;
        }
        return $newRow;
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si les proprietes columns et row sont vides
     */
    public function toString(): string{
        if(empty($this->columns) || empty($this->row)){
            throw new \Exception('columns and row properties are required');
        }
        $row = [];
        foreach($this->columns as $column){
            $key = array_search($column, $this->columns);
            $row[] = $this->row[$key] ?? "NULL";
        }

        return ' (' . implode(', ', $row) . ')';
    }
}