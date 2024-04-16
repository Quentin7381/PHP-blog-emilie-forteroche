<?php

namespace Utils\DBQuery\components;

/**
 * Requete SQL abstraite
 */
abstract class AbstractQuery{
    /**
     * Liste des propriétés qui recevront des objets
     * Ces objets sont instanciés et recoivent les valeurs qu'auraient du recevoir les proprietes
     * E.g. $delete->from = 'table_name' | $delete->from = new From('table_name');
     *
     * @var array $objectPlaceholders Liste des cles
     */
    protected array $objectPlaceholders = [];

    /**
     * Setter
     * Par ordre de priorité :
     * 1. set_$name existe, on l'appelle
     * 2. $name est dans objectPlaceholders, on instancie si besoin la classe correspondante
     * 3. rien de tout ça, on set la propriete
     *
     * @param string $name Nom de la propriété
     * @param mixed $value Valeur de la propriété
     */
    public function __set(string $name, mixed $value){
        // Appel de la methode set_$name
        if(method_exists($this, 'set_'.$name)){
            $this->{'set_'.$name}($value);
            return;
        }

        // Instanciation de l'objet recepteur
        if(in_array($name, $this->objectPlaceholders)){
            $class = $this->buildClassName($name);
            if(empty($value)){
                $this->$name = null;
                return;
            }
            if(!$value instanceof $class){
                $value = new $class($value);
            }
            $this->$name = $value;
            return;
        }

        // Affectation de la propriete
        $this->$name = $value;
    }

    /**
     * Getter
     * Par ordre de priorité :
     * 1. get_$name existe, on l'appelle
     * 2. $name est dans objectPlaceholders, on instancie si besoin la classe correspondante
     * 3. rien de tout ça, on retourne la propriete
     *
     * @param string $name Nom de la propriété
     * @return mixed Valeur de la propriété
     */
    public function __get(string $name){
        // Appel de la methode get_$name
        if(method_exists($this, 'get_'.$name)){
            return $this->{'get_'.$name}();
        }

        // Instanciation de l'objet recepteur
        if(in_array($name, $this->objectPlaceholders)){
            if(!isset($this->$name)){
                $class = $this->buildClassName($name);
                $this->$name = new $class();
            }
            return $this->$name;
        }
        
        // Retour de la propriete
        return $this->$name;
    }

    /**
     * Construit le nom de la classe a instancier
     *
     * @param string $key Nom de la propriete
     * @return string Nom de la classe
     */
    private function buildClassName(string $key){
        $key = ucfirst($key);
        return 'Utils\DBQuery\components\\'.$key;
    }

    /**
     * @return string Requete SQL
     * Peut throw Exception si une propriete obligatoire est vide
     */
    public function __toString(){
        return $this->toString();
    }

    /**
     * @return string Requete SQL
     * Peut throw Exception si une propriete obligatoire est vide
     */
    abstract public function toString();

    /**
     * Constructeur
     */
    abstract public function __construct();
}
