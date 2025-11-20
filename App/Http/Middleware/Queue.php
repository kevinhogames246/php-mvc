<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Closure;
use Exception;

class Queue{

    /**
     * Mapeamento de middlewares
     * @var array
     */
    private static $map = [];

    /**
     * Mapeamento de middlewares padrao para todas as rotas
     * @var array
     */
    private static $default = [];

    private $middlewares = [];

    private $controller;

    private $controllerArgs = [];

    /**
     * Metodo responsavel por contruir a calsse de fila de middleswares
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs){
        $this->middlewares      = array_merge(self::$default, $middlewares);
        $this->controller       = $controller;
        $this->controllerArgs   = $controllerArgs;
    }

    /**
     * Metodo responsavel por definir o mapeaemnto de middlewares
     * @param array $map
     */ 
    public static function setMap($map){
        self::$map = $map;
    }

    /**
     * Metodo responsavel por definir o mapeaemnto de middlewares
     * @param array $default
     */ 
    public static function setDefault($default){
        self::$default = $default;
    }

    /**
     * Metodo responsavel por executar o próximo nivel da fila de middlewares
     * @param Request $request
     * @return Response
     */
    public function next($request){
        
        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);
        
        $middleware = array_shift($this->middlewares);
        
        // echo '<pre>';
        // print_r($this->middlewares);
        // echo '</pre>';exit;
        
        if(!isset(self::$map[$middleware])){
            throw new Exception("Problemas ao processar o middleware da requisição", 500);
            
        }

        $queue = $this;

        $next = function($request) use($queue){
            return $queue->next($request);
        };
        
        return (new self::$map[$middleware])->handle($request, $next);
    }
}