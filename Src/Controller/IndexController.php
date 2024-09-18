<?php

namespace Src\Controller;

use Config\TemplateConfig;

class IndexController extends TemplateConfig
{
    public function index()
    {
        $this->view("site/index", ["title" => "Index"]);
    }

    public function form()
    {
        session_start();
        $this->view("site/form", ["title" => "Formulário"]);
    }

    public function test()
    {
        $arquivo = 'Src/NOSQL/dados.json';

// Verificar se o arquivo existe
if (file_exists($arquivo)) {
    // Ler o conteúdo do arquivo JSON
    $conteudo = file_get_contents($arquivo);

    // Decodificar o JSON em um array PHP
    $dados = json_decode($conteudo, true);

    // Verificar se a decodificação foi bem-sucedida
    if (is_array($dados)) {
        // Exibir ou manipular os dados conforme necessário
        foreach ($dados as $registro) {
            echo "ID: " . $registro['id'] . "<br>";
            echo "Nome: " . $registro['Nome'] . "<br>";
            echo "Destino: " . $registro['Destino'] . "<br>";
            echo "Está indo ?: " . $registro['Está indo ?'] . "<br>";
            echo "Passeios: " . $registro['Passeios'] . "<br>";
            echo "Roteiro: " . $registro['Roteiro'] . "<br><br>";
        }
    } else {
        echo "Erro ao decodificar o JSON.";
    }
} else {
    echo "Arquivo JSON não encontrado.";
}
    }


    public function resultado($data)
    {
        // Verifica se o ID é válido e foi fornecido
        $idProcurado = isset($data['id']) ? intval($data['id']) : null;
        if ($idProcurado === null || $idProcurado <= 0) {
            return "ID inválido.";
        }
    
        $arquivo = 'Src/NOSQL/dados.json';
    
        // Verifica se o arquivo JSON existe
        if (!file_exists($arquivo)) {
            return "Arquivo JSON não encontrado.";
        }
    
        $dados = json_decode(file_get_contents($arquivo), true);
    
        // Busca o registro com o ID fornecido
        foreach ($dados as $registro) {
            if ($registro['id'] == $idProcurado) {
                // Exibe os dados do registro encontrado em HTML
                //echo "<h2>Registro Encontrado</h2>";
                //echo "<table border='1'>";
                //foreach ($registro as $chave => $valor) {
                   // echo "<tr><td><strong>$chave:</strong></td><td>" . htmlspecialchars($valor) . "</td></tr>";
               // }
                //echo "</table>";
                $this->view("site/resultado", ["title" => "Resultado da busca", "array" => $registro]);
                return; // Saída completa, não precisa de mais processamento
            }
        }
    
        echo "Registro com ID $idProcurado não encontrado.";
    }

    
}