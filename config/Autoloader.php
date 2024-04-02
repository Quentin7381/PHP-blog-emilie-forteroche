<?php

/**
 * Charge automatiquement les fichiers PHP contenant les classes requises
 */
class Autoloader {

    protected string $prefix = '';
    protected string $dir = '';

    public function __construct(string $dir, string $prefix = '') {
        $this->dir = $dir;
        $this->prefix = $prefix;
        spl_autoload_register([$this, 'load']);
    }

    /**
     * Charge le fichier contenant la classe demandée
     *
     * Le fichier doit être dans le dossier includes (configurable dans config/Config.php)
     * Il doit avoir le même nom que la classe
     *
     * @param string $fullClassName Nom de la classe
     */
    public function load($fullClassName): bool{
        // Si le namespace n'est pas bon, return
        $match = strpos($fullClassName, $this->prefix);
        if($match === false || $match !== 0){
            return false;
        }

        // On retire le namespace racine
        $path = substr($fullClassName, strlen($this->prefix));
        $path = $this->dir . $path;

        // On essaye d'inclure le fichier
        if(file_exists($path.'.php')){
            require_once $path.'.php';
            return true;
        } else {
            return false;
        }
    }
}
