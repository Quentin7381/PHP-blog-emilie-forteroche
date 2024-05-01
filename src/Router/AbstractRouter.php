<?php

namespace Router;

use View\View;

/**
 * Classe chargee de router les urls.
 *
 * Traite l'url lors de l'appel de la methode \_\_ROUTE__.
 * Ce traitement se fait par appel de methodes de noms correspondants aux segments de l'url.
 *
 * Par exemple, l'url /test/test2/test3 appelle la methode test.
 * Elle pourra utiliser test2 et test3 comme parametres ou comme noms de sous-methodes.
 */
abstract class AbstractRouter{
    /**
     * @var array $url
     * Tableau contenant les différentes parties de l'url.
     */
    protected array $url = [];

    /**
     * @var array $get
     * Tableau associatif contenant les paramètres GET de l'url.
     */
    protected array $get = [];

    /**
     * @var array $post
     * Tableau associatif contenant les paramètres POST de l'url.
     */
    protected array $post = [];

    /**
     * @var AbstractRouter $__PREVIOUS__
     * Contient le router precedent.
     */
    protected ?AbstractRouter $previous;

    /**
     * @var bool $debug
     * Active ou desactive l'affichage des informations de debug.
     */
    public bool $debug = false;

    // ----- CORE FUNCTIONS -----

    /**
     * Constructeur de la classe.
     * @param AbstractRouter $previous
     * Router precedent. Sera utilise pour la recuperation des proprietes.
     */
    final public function __construct(?AbstractRouter $previous = null){
        $this->previous = $previous;

        foreach($previous ?? [] as $key => $value){
            if($key == 'previous'){continue;}
            $this->$key = $value;
        }
    }

    /**
     * Decompose l'url en plusieurs segments.
     * @param string $url
     */
    final protected function __DECOMPOSE__(string $url) : void{
        $parsedUrl = parse_url($url);

        // Segmentation du chemin
        $url = $parsedUrl['path'];
        $url = trim($url, '/');
        $url = explode('/', $url);
        if(empty($url[0])){
            $url = [];
        }
        $this->url = $url;

        // Recuperation des parametres GET
        $get = $parsedUrl['query'] ?? '';
        $get = explode('&', $get);
        if(empty($get[0])){
            $get = [];
        }

        // Mise des parametres GET sous forme de tableau associatif
        $newArgs = [];
        foreach($get as $key => $arg){
            $arg = explode('=', $arg);
            $newArgs[$arg[0]] = $arg[1];
        }
        $this->get = $newArgs ?? [];
        
        // Recuperation des parametres POST
        $this->post = $_POST ?? [];
    }
    
    /**
     * Route l'url vers la methode correspondante.
     *
     * Si le segment actuel de l'url est une methode existante de la classe, la methode est appelee.
     * Si le segment actuel est vide, la methode _index est appelee.
     * Sinon, la methode _404 est appelee.
     *
     * @param string $url
     * Tableau contenant les differents segments de l'url.
     * Utilise seulement lors de l'appel du premier router.
     */
    final public function __ROUTE__(string $url = null) : void{
        // Decomposition de l'url
        if($url !== null) {
            self::__DECOMPOSE__($url);
        }

        // Affichage des informations de debug
        if($this->debug){
            $previousClass = (isset($this->previous)) ? $this->previous::class : null;
            var_dump([
                'router' => static::class,
                'previous' => $previousClass,
                'url' => $this->url,
                'get' => $this->get,
                'post' => $this->post
            ]);
        }

        // Methode par defaut
        if(empty($this->url)) {$this->url = ['_index'];}

        // Appel de la methode correspondante
        $method = array_shift($this->url);
        $method = strtolower($method);
        if(!method_exists(static::class, $method)){
            $method = '_404';
        }

        static::$method();
    }

    // ----- ROUTING FUNCTIONS -----

    public function _index(){}

    public function _404(){
        throw new \Exception('404 : Not Found');
    }

    public function _403(){
        throw new \Exception('403 : Forbidden');
    }
}
