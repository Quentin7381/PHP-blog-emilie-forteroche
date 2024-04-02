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

class Select extends AbstractQuery{

    protected const COMPONENTS_NAMESPACE = 'Utils\DBQuery\components\\';
    protected $objectPlaceholders = [
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

    public function toString(): string {
        $result = 'SELECT ';

        if(
            empty($this->from)
        ){
            throw new Exception('from property is required');
        }

        if(empty($this->fields)) {
            $result .= '*';
        } else {
            $result .= implode(', ', $this->fields) . ' ';
        }

        $result .= $this->from->toString() ?? '';

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

        return $result;
    }
}