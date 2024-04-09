<?php

namespace Utils\DBQuery\components;

/**
 * Liste des valeurs a inserer
 */
class Values extends AbstractQuery implements \ArrayAccess {
    /**
     * Liste des noms de colonnes
     * Doit etre defini pour la creation de rows
     *
     * @var array $columns
     */
    protected array $columns = [];

    /**
     * Liste des lignes
     *
     * @var array $rows
     */
    protected array $rows = [];

    /**
     * Constructeur
     *
     * @param array $columns Liste des colonnes
     * @param array $rows Liste des lignes
     */
    public function __construct(array $columns = [], array $rows = []) {
        $this->columns = $columns;
        $this->rows = $rows;
    }

    public function offsetExists($offset): bool{
        return isset($this->rows[$offset]);
    }

    /**
     * Retourne une ligne
     * Si la ligne n'existe pas, on la cree (new Row)
     *
     * @param int $offset
     * @return Row
     */
    public function offsetGet($offset): Row{
        if(!isset($this->rows[$offset])) $this->rows[$offset] = new Row($this->columns);
        return $this->rows[$offset];
    }

    /**
     * Ajoute une ligne
     * Si la ligne n'est pas une instance de Row, on la cree
     * Le tableau $columns doit etre defini
     *
     * @param int $offset
     * @param mixed $row
     */
    public function offsetSet($offset, $row): void{
        if($offset === null) $offset = count($this->rows);

        if(!$row instanceof Row){
            $row = new Row($this->columns, $row);
        }

        $this->rows[$offset] = $row;
    }

    public function offsetUnset($offset): void{
        unset($this->rows[$offset]);
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si les proprietes columns et rows sont vides
     */
    public function toString(): string{
        if(empty($this->columns) || empty($this->rows)){
            throw new \Exception('columns and rows properties are required');
        }
        $rows = [];
        foreach($this->rows as $row){
            $rows[] = $row->toString();
        }

        return ' (' . implode(', ', $this->columns) . ') VALUES' . implode(',', $rows);
    }
}
