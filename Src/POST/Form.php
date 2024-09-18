<?php

namespace Src\POST;
use Src\Services\IA;
use Src\Services\Validate;

class Form 
{

    private string $nome;
    private string $cidade;
    private string $acompanhado;
    private $dias;
    private $passeios;
    private Validate $validate;

    public function __construct()
    {
        $this->nome = $_POST['nome'];
        $this->cidade = $_POST['cidade'];
        $this->acompanhado = $_POST['acompanhado'];
        $this->passeios = $_POST['passeios'];
        $this->validate = new Validate;
        $this->dias = $_POST['dias'];
    }

    public function Result()
    {

        session_start();
        if(!$this->request()){
           $this->gerar();
        }

    }

    private function request()
    {
       $data = [
          "Nome" => $this->nome,
          "Destino" => $this->cidade,
          "Está indo ?" => $this->acompanhado,
          "Quantos dias ?" => $this->dias,
          "Opções de passeios" => $this->passeios
       ];

       if($this->validate->validate($data) != false){
 
        setSession("Message", messageWarning($this->validate->validate($data)));
        redirectBack();
        return true;
       }

       return false;
       
       
    }


    private function gerar()
    {

        $arquivo = "Src/NOSQL/dados.json";

        if(file_exists($arquivo)){
           $conteudo = file_get_contents($arquivo);
           $dadosExistentes = json_decode($conteudo, true);

           if(!is_array($dadosExistentes)){
                $dadosExistentes = [];
           }

           $ultimoId = 0;
           if(!empty($dadosExistentes)){
                $ultimoDado = end($dadosExistentes);
                $ultimoId = $ultimoDado["id"];
           }

          $novoId = $ultimoId + 1;
        }else{
          $dadosExistentes = [];
          $novoId = 1;
        }


        $passeios = implode(', ', $this->passeios);
        $texto = "Olá, me chamo(a) {$this->nome}, vou viajar para {$this->cidade} {$this->acompanhado} e quero montar um cronograma de turismo com {$passeios}.
        Observação: colocar o endereço dos locais
        comece o texto do roteiro informando meu nome no inicio, exemplo, Roteiro de turismo para {$this->nome}
        ";
        $ia = new IA($texto);
        

        $array = [
            "id" => $novoId,
            "Nome" => $this->nome,
            "Destino" => $this->cidade,
            "Está indo ?" => $this->acompanhado,
            "Quantos dias ?" => $this->dias,
            "Passeios" => $passeios,
            "Roteiro" => $ia->gerar()
        ];

        $dadosExistentes[] = $array;
        $dadosAtualizados = json_encode($dadosExistentes, JSON_PRETTY_PRINT);
        
        if(file_put_contents($arquivo, $dadosAtualizados) === false){
            redirectBack();
        }else{
            redirect(routerConfig()."/resultado/$novoId");
        }



    }
}