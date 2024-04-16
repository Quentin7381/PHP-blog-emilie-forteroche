<?php

namespace Router;

abstract class Router{
    protected $url = [];
    protected $get = [];
    protected $post = [];
    protected $oldUrl = null;

    protected ?Router $__PREVIOUS__;

    // ----- CORE FUNCTIONS -----
    final public function __construct(?Router $previous = null){
        $this->__PREVIOUS__ = $previous;

        foreach($previous ?? [] as $key => $value){
            if($key == '__PREVIOUS__'){continue;}
            $this->$key = $value;
        }
    }

    final protected function __DECOMPOSE__($url){
        $parsedUrl = parse_url($url);

        // path
        $url = $parsedUrl['path'];
        $url = trim($url, '/');
        $url = explode('/', $url);
        if(empty($url[0])){
            $url = [];
        }
        $this->url = $url;

        // args
        $get = $parsedUrl['query'] ?? '';
        $get = explode('&', $get);
        if(empty($get[0])){
            $get = [];
        }

        $newArgs = [];
        foreach($get as $key => $arg){
            $arg = explode('=', $arg);
            $newArgs[$arg[0]] = $arg[1];
        }
        $this->get = $newArgs ?? [];
        
        $this->post = $_POST ?? [];
    }
    
    final public function __ROUTE__($url = null){
        // Decomposition de l'url
        if($url !== null) {
            self::__DECOMPOSE__($url);
        }

        // $previousClass = (isset($this->__PREVIOUS__)) ? $this->__PREVIOUS__::class : null;
        // var_dump([
        //     'router' => static::class,
        //     'previous' => $previousClass,
        //     'url' => $this->url,
        //     'get' => $this->get,
        //     'post' => $this->post
        // ]);

        if(empty($this->url)) {$this->url = ['_index'];}


        $method = array_shift($this->url);
        $method = strtolower($method);
        if(!method_exists(static::class, $method)){
            $this->oldUrl = $method;
            $method = '_404';
        }

        static::$method();
    }

    // ----- ROUTING FUNCTIONS -----

    public function _index(){}

    public function _404(){
        echo '<h1>404 : Unknown</h1>';
    }

    public function _403(){
        echo '<h1>403 : Forbidden</h1>';
    }
}
