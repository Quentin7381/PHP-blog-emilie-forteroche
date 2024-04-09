<?php

namespace Utils\DBQuery\components;

/**
 * Condition SQL
 *
 * Agregation d'une colonne cible, d'un operateur et d'une valeur
 */
class Where extends AbstractQuery implements \ArrayAccess{
    /**
     * Liste d'objets Condition
     * Represente les conditions de la requete
     *
     * @var array $conditions
     */
    protected array $conditions = [];

    /**
     * Liste des operateurs logiques
     * Les operateurs logiques d'index $i sont appliques avant les conditions d'index $i
     *
     * @var array $operators
     */
    protected array $operators = [];

    /**
     * Si value est un tableau, on considere que value[0] est la valeur et value[1] est l'operateur
     * Si value[1] n'est pas defini, ou que value n'est pas un tableau on considere que l'operateur est 'AND'
     */
    public function offsetSet($offset, $value): void {
        if($offset === null) $offset = count($this->conditions);
        if(!is_array($value)) $value = [$value];

        $this->conditions[$offset] = $value[0];
        if($offset > 0) {
            $this->operators[$offset] = $value[1] ?? 'AND';
        }
    }

    public function offsetUnset($offset): void {
        unset($this->conditions[$offset]);
        unset($this->operators[$offset-1]);
    }

    public function offsetExists($offset): bool {
        return isset($this->conditions[$offset]);
    }

    public function offsetGet($offset): array {
        return [$this->conditions[$offset], $this->operators[$offset-1] ?? 'AND'];
    }

    /**
     * @return string Requete SQL
     * @throws \Exception Si la propriete conditions est vide
     */
    public function toString(): string {
        if(empty($this->conditions)){
            throw new \Exception('conditions property is required');
        }
        $str = ' WHERE';
        foreach($this->conditions as $key => $condition){
            if(isset($this->operators[$key])) $str .= ' ' . $this->operators[$key];
            $str .= $condition->toString();
        }

        return $str;
    }

    /**
     * Constructeur
     *
     * Utilise des conditions sous la forme
     * [condition1, condition2, ...]
     * OU
     * [condition1, [condition2, 'OR'], [condition3, 'AND'], ...]
     *
     * Chaque condition est de forme
     * new Condition($column, $value, $operator = '=')
     *
     *
     * @param array|null $conditions Conditions de la requete
     */
    public function __construct(array $conditions = []){
        foreach($conditions as $key => $condition){
            $this->offsetSet($key, $condition);
        }
    }
}
