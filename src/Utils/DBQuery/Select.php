<?php

namespace Utils\DBQuery;
use Exception;
use Utils\DBQuery\components\AbstractQuery;
use Utils\DBQuery\components\From;
use Utils\DBQuery\components\GroupBy;
use Utils\DBQuery\components\Having;
use Utils\DBQuery\components\Limit;
use Utils\DBQuery\components\Offset;
use Utils\DBQuery\components\OrderBy;
use Utils\DBQuery\components\Where;

/**
 * Requete SQL SELECT
 *
 * --- Utilisation
 * $select->fields = ['column_name', 'column_name'];
 * $select->from = 'table_name';
 * $select->where[] = [new Condition('column_name', 'value')];
 * $select->where[] = [new Condition('column_name', 'value', 'LIKE'), 'OR'];
 * $select->orderBy[] = ['column_name', 'ASC'];
 * $select->limit = 10;
 * $select->offset = 5;
 * $select->groupBy = ['column_name'];
 * $select->having[] = [new Condition('column_name', 'value')];
 * $select->having[] = [new Condition('column_name', 'value', 'LIKE'), 'OR'];
 */
class Select extends AbstractQuery{
    protected array $objectPlaceholders = [
        'from',
        'where',
        'orderBy',
        'limit',
        'offset',
        'groupBy',
        'having'
    ];

    // ----- SELECT properties -----
    protected array $fields;
    protected ?From $from = null;
    protected ?Where $where = null;
    protected ?OrderBy $orderBy = null;
    protected ?Limit $limit = null;
    protected ?Offset $offset = null;
    protected ?GroupBy $groupBy = null;
    protected ?Having $having = null;

    // ----- CONSTRUCTOR -----
    public function __construct(array $fields = []) {
        $this->fields = $fields;
    }

    /**
     * @return string Requête SQL
     * @throws Exception Si la propriété from est vide
     */
    public function toString(): string {
        // Verification des proprietes
        if(empty($this->from)){
            throw new Exception('from property is required');
        }

        $result = 'SELECT ';

        // Ajout des champs a selectionner
        if(empty($this->fields)) {
            $result .= '*';
        } else {
            $result .= implode(', ', $this->fields) . ' ';
        }

        // Ajout de la table
        $result .= $this->from->toString() ?? '';

        // Ajout des autres composants
        $options = [
            'where',
            'orderBy',
            'limit',
            'offset',
            'groupBy',
            'having'
        ];
        foreach($options as $component) {
            if(empty($this->$component)) continue;
            $result .= $this->$component->toString();
        }

        // Retour du resultat
        return $result;
    }
}