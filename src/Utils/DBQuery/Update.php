<?php

namespace Utils\DBQuery;

/**
 * Requete SQL UPDATE
 *
 * --- Utilisation
 * $update->table = 'table_name';
 * $update->set[] = ['column_name' => 'value', 'column_name' => 'value'];
 * $update->set[2]['column_name'] = 'value';
 * $update->where[] = [new Condition('column_name', 'value')];
 * $update->where[] = [new Condition('column_name', 'value', 'LIKE'), 'OR'];
 */
class Update extends components\AbstractQuery {
    protected ?string $table;
    protected ?components\Set $set;
    protected ?components\Where $where;

    /**
     * Constructeur
     *
     * @param string $table Nom de la table
     * @param array $set Valeurs à mettre à jour
     * @param array $where Conditions de mise à jour
     */
    public function __construct(string $table = null, array $set = [], array $where = []) {
        $this->table = $table;
        $this->set = new components\Set($set);
        $this->where = new components\Where($where);
    }

    /**
     * @return string Requête SQL
     * @throws \Exception Si les propriétés table, set et where sont vides
     */
    public function toString() {
        if(empty($this->table) || empty($this->set) || empty($this->where)){
            throw new \Exception('table, set and where properties are required');
        }

        $str = "UPDATE $this->table";
        $str .= $this->set->toString();
        $str .= $this->where->toString();
        return $str;
    }

}
