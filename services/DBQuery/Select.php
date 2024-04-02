<?php

namespace services\DBQuery;
use Exception;
use services\DBQuery\components\AbstractQuery;
use services\DBQuery\components\From;
use services\DBQuery\components\GroupBy;
use services\DBQuery\components\Having;
use services\DBQuery\components\Limit;
use services\DBQuery\components\Offset;
use services\DBQuery\components\OrderBy;
use services\DBQuery\components\Where;

class Select extends AbstractQuery{

    protected const COMPONENTS_NAMESPACE = 'services\DBQuery\components\\';
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

        $toPrint = [
            'where',
            'orderBy',
            'limit',
            'offset',
            'groupBy',
            'having'
        ];

        foreach($toPrint as $component) {
            if(!empty($this->$component)) {
                $result .= $this->$component->toString();
            }
        }

        return $result;
    }
}