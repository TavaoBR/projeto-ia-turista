<?php 

use Src\Routers\Routers;

require_once("vendor/autoload.php");

//error_reporting(1);

class Index 
{
    protected $router;
    protected $method;

    public function __construct(){
        try{
            $this->router = new Routers;
            $this->method = $_SERVER["REQUEST_METHOD"];
        }catch(Exception $e){
            error_log($e->getMessage(), 0);
            exit('Desculpe, ocorreu um erro interno.');
        }
    }

    private function method($method){
        if($this->router){
           switch($method){
                case 'Get':
                 case 'GET':
                  case 'get':
                    $this->router->get();
                break;
                
                case 'Post':
                 case 'POST':
                  case 'post':
                    $this->router->post();
                break;    
           }
        }
    } 

    public function render(){
        return $this->method($this->method);
    }
}


$index = new Index;
$index->render();


