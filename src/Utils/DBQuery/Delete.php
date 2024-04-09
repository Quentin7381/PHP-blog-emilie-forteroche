<?php

namespace Utils\DBQuery;
use Utils\DBQuery\components\AbstractQuery;
use Utils\DBQuery\components\From;
use Utils\DBQuery\components\Where;

/**
 * Requete SQL DELETE
 *
 * --- Utilisation
 * $delete->from = 'table_name';
 * $delete->where[] = [new Condition('column_name', 'value')];
 * $delete->where[] = [new Condition('column_name', 'value', 'LIKE'), 'OR'];
 * ];
 */
class Delete extends AbstractQuery {
    protected array $objectPlaceholders = [
        'from',
        'where'
    ];
    protected ?From $from;
    protected ?Where $where;

    /**
     * Constructeur
     *
     * @param string $from Nom de la table
     * @param array $where Conditions de suppression
     */
    public function __construct(string $from = '', array $where = []) {
        if(!empty($from)){
            $this->__set('from', $from);
        }
        if(!empty($where)){
            $this->__set('where', $where);
        }
    }
    
    /**
     * @return string Requête SQL
     * @throws \Exception Si la propriété from est vide
     */
    public function toString() {
        if(empty($this->from)){
            throw new \Exception('from property is required');
        }

        $query = "DELETE";
        $query .= $this->from->toString();
        if ($this->where) {
            $query .= $this->where->toString();
        }
        return $query;
    }
}
