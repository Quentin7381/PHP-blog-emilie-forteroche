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
        $this->from = new From();
        $this->where = new Where();
        $this->orderBy = new OrderBy();
        $this->limit = new Limit();
        $this->offset = new Offset();
        $this->groupBy = new GroupBy();
        $this->having = new Having();
    }

    public function set_from($from) {
        if(!$from instanceof From) {
            $from = new From($from);
        }
        $this->from = $from;
    }

    public function set_where($where) {
        if(!$where instanceof Where) {
            $where = new Where($where);
        }
        $this->where = $where;
    }

    public function set_orderBy($orderBy) {
        if(!$orderBy instanceof OrderBy) {
            $orderBy = new OrderBy($orderBy);
        }
        $this->orderBy = $orderBy;
    }

    public function set_limit($limit) {
        if(!$limit instanceof Limit) {
            $limit = new Limit($limit);
        }
        $this->limit = $limit;
    }

    public function set_offset($offset) {
        if(!$offset instanceof Offset) {
            $offset = new Offset($offset);
        }
        $this->offset = $offset;
    }

    public function set_groupBy($groupBy) {
        if(!$groupBy instanceof GroupBy) {
            $groupBy = new GroupBy($groupBy);
        }
        $this->groupBy = $groupBy;
    }

    public function set_having($having) {
        if(!$having instanceof Having) {
            $having = new Having($having);
        }
        $this->having = $having;
    }

    public function toString(): string {
        $result = 'SELECT ';

        if(empty($this->fields)) {
            $result .= '*';
        } else {
            $result .= implode(', ', $this->fields) . ' ';
        }

        $result .= $this->from->toString() ?? '';
        $result .= $this->where->toString();
        $result .= $this->orderBy->toString();
        $result .= $this->limit->toString();
        $result .= $this->offset->toString();
        $result .= $this->groupBy->toString();
        $result .= $this->having->toString();

        return $result;
    }
}