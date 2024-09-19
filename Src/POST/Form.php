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
        $texto = "Olá, me chamo {$this->nome}. Estou planejando uma viagem para {$this->cidade} {$this->acompanhado} e gostaria de criar um cronograma turístico que inclua {$passeios} ao longo de {$this->dias}.

Observação: por favor, não inclua informações de outras cidades além de {$this->cidade}.

Inicie o roteiro mencionando meu nome, por exemplo: Roteiro de turismo para {$this->nome}.";
        $ia = new IA($texto);
        $textoGerado1 = $ia->gerar();

        $formeEsse = "Formate o texto abaixo utilizando tags HTML. Não é necessário usar as tags <html>, <h1> ou <h2>. Siga o padrão fornecido em {$this->exemplos()}. Observações:
        Use a classe class='resume-title' nas tags apropriadas.
        Não remova o título, que deve ser inserido como <h3 class='resume-title'>.
        Texto a ser formatado: $textoGerado1";

        $ia2 = new IA( $formeEsse);
        $textoGerado2 = $ia2->gerar();

        $array = [
            "id" => $novoId,
            "Nome" => $this->nome,
            "Destino" => $this->cidade,
            "Está indo ?" => $this->acompanhado,
            "Quantos dias ?" => $this->dias,
            "Passeios" => $passeios,
            "Roteiro" => $textoGerado2
        ];

        $dadosExistentes[] = $array;
        $dadosAtualizados = json_encode($dadosExistentes, JSON_PRETTY_PRINT);
        
        if(file_put_contents($arquivo, $dadosAtualizados) === false){
            redirectBack();
        }else{
            redirect(routerConfig()."/resultado/$novoId");
        }



    }


    private function exemplos()
    {
         return " 
         Não utilize esse texto, é apenas um exemplo para usar os elementos de html
         <p><em><h3>Roteiro de Turismo para Gustavo Oliveira Fagundes em São Paulo (2 Dias)</h3>

            <h4>Dia 1</h4>
            <h4 class='resume-title'>Atrações Culturais:</h4>
            <ol>
                <li>Museu de Arte de São Paulo (MASP) (Avenida Paulista, 1578)</li>
            </ol>

            <h4 class='resume-title'>Atrações Históricas:</h4>
            <ol>
                <li>Museu da Língua Portuguesa (Praça da Sé, 102)</li>
                <li>Igreja da Sé (Praça da Sé, s/n)</li>
            </ol>

            <h4 class='resume-title'>Passeios Gastronômicos:</h4>
            <ol>
                <li>Mercado Municipal (Rua da Cantareira, 306)</li>
                <li>Vila Madalena (Rua Aspicuelta, s/n)</li>
            </ol>

            <h4 class='resume-title'>Passeios Noturnos:</h4>
            <ol>
                <li>Avenida Paulista (Avenida Paulista, s/n)</li>
                <li>Terraço Itália (Avenida Ipiranga, 344)</li>
            </ol>

            <h4>Dia 2</h4>
            <h4 class='resume-title'>Atrações Culturais:</h4>
            <ol>
                <li>Pinacoteca do Estado de São Paulo (Praça da Luz, 2)</li>
                <li>Itaú Cultural (Avenida Paulista, 149)</li>
            </ol>

            <h4 class='resume-title'>Atrações Históricas:</h4>
            <ol>
                <li>Museu do Ipiranga (Parque da Independência, s/n)</li>
                <li>Conjunto Arquitetônico da Universidade de São Paulo (USP) (Cidade Universitária, s/n)</li>
            </ol>

            <h4 class='resume-title'>Passeios Gastronômicos:</h4>
            <ol>
                <li>Liberdade (Rua Galvão Bueno, s/n)</li>
                <li>Bixiga (Rua Treze de Maio, s/n)</li>
            </ol>

            <h4 class='resume-title'>Passeios Noturnos:</h4>
            <ol>
                <li>Beco do Batman (R. Gonçalo Afonso, s/n)</li>
                <li>Sky Nightclub (Rua Augusta, 2552)</li>
            </ol></em></p>";
    }
}