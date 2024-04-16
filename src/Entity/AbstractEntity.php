<?php

namespace Entity;

abstract class AbstractEntity
{
    // Par défaut l'id vaut -1, ce qui permet de vérifier facilement si l'entité est nouvelle ou pas. 
    protected int $id = -1;

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     *
     * @param array $data
     */
    public function __construct(array $data = []) 
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // ----- SETTERS & GETTERS DYNAMIQUES -----

    public function __set(string $name, mixed $value) : void
    {
        // Priorite au setter custom
        $setter = 'set'.ucfirst($name);
        if(method_exists($this, $setter)){
            $this->{$setter}($value);
            return;
        }

        // Setter generique
        if(property_exists($this, $name)){
            $this->$name = $value;
        }

        // Si la propriete n'existe pas
        // throw new \Exception("La propriété $name n'existe pas");
    }

    public function __get(string $name) : mixed
    {
        // Priorite au getter custom
        $getter = 'get'.ucfirst($name);
        if(method_exists($this, $getter)){
            return $this->{$getter}();
        }

        // Getter generique
        if(property_exists($this, $name)){
            return $this->$name;
        }

        // Si la propriete n'existe pas
        throw new \Exception("La propriété $name n'existe pas");
    }

    public function __call(string $name, array $arguments) : mixed
    {
        // Reimplementation methodes get
        if (strpos($name, 'set') === 0) {
            $property = lcfirst(substr($name, 3));

            // On passe par __set en cas de surcharge generales
            $this->__set($property, $arguments[0]);

        // Reimplementation methodes set
        } elseif (strpos($name, 'get') === 0) {
            $property = lcfirst(substr($name, 3));

            // On passe par __get en cas de surcharge generales
            return $this->__get($property);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * @return void
     */
    protected function hydrate(array $data) : void 
    {
        foreach ($data as $key => $value) {
            // Transformation de la cle db en cle camelCase
            $key = str_replace('_', '', ucwords($key, '_'));
            $key = lcfirst($key);

            $this->__set($key, $value);
        }
    }

    /**
     * Setter pour l'id.
     * @param int $id
     * @return void
     */
    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    
    /**
     * Getter pour l'id.
     * @return int
     */
    public function getId() : int 
    {
        return $this->id;
    }
}
