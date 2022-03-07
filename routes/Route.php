<?php

namespace Router;

use Database\DBConnection;

class Route{

    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path,'/');
        $this->action = $action;
    }
    public function matches(string $url){
        // Rechercher et remplacer par une expression rationnelle standard
        $path = preg_replace('#:([\w]+)#','([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if(preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            return true;
        }else{
            return false;
        }
    }
    public function execute()
    {
        $params = explode('@', $this->action);
        // TODO 
        // METTRE DANS DES VARIABLES D'ENVIRONNEMENT
        $controller = new $params[0](new DBConnection('myapp', 'localhost', 'root', ''));
        $method = $params[1];

        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}