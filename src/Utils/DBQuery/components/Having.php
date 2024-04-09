<?php

namespace Utils\DBQuery\components;

/**
 * Having SQL
 *
 * Agregation d'une liste de conditions et de jonctions (AND, OR)
 */
class Having extends AbstractQuery implements \ArrayAccess{
    
    /**
     * Liste d'objets Condition
     * Represente les conditions de la requete
     *
     * @var array $conditions
     */
    protected array $conditions = [];

    /**
     * Liste des jonctions logiques (AND, OR)
     * Les jonctions logiques d'index $i sont appliquees avant les conditions d'index $i
     *
     * @var array $junctions
     */
    protected array $junctions = [];

    /**
     * Si value est un tableau, on considere que value[0] est la valeur et value[1] est la jonction
     * Si value[1] n'est pas defini, ou que value n'est pas un tableau on considere que la jonction est 'AND'
     */
    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->conditions);

        if(!is_array($value)) $value = [$value];

        $this->conditions[$offset] = $value[0];
        if($offset > 0) {
            $this->junctions[$offset] = $value[1] ?? 'AND';
        }
    }

    public function offsetUnset($offset): void {
        unset($this->conditions[$offset]);
        unset($this->junctions[$offset-1]);
    }

    public function offsetExists($offset): bool {
        return isset($this->conditions[$offset]);
    }

    public function offsetGet($offset): array {
        return [$this->conditions[$offset], $this->junctions[$offset-1] ?? 'AND'];
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete conditions est vide
     */
    public function toString(): string {
        if(empty($this->conditions)){
            throw new \Exception('conditions property is required');
        }
        $str = ' HAVING';
        foreach($this->conditions as $key => $condition){
            if(isset($this->junctions[$key])){
                $str .= " {$this->junctions[$key]}";
            }

            $str .= $condition->toString();
        }

        return $str;
    }

    /**
     * Constructeur
     *
     * @var array $conditions Liste des conditions
     * Format: ['column' => condition]
     * OU ['column' => [condition, junction]]
     */
    public function __construct(array $conditions = []){
        foreach($conditions as $key => $condition){
            $this->offsetSet($key, $condition);
        }
    }
}