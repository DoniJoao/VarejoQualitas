<?php
session_start();

// Configura o cabeçalho para o navegador entender que a resposta é um JSON
header('Content-Type: application/json; charset=utf-8');

// Inicializa a resposta padrão como erro
$resposta = ['sucesso' => false, 'mensagem' => 'Requisição inválida.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // SEGURANÇA: Filtra e limpa os dados recebidos contra XSS e injeções de texto
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

    // Validação estrita dos dados
    if ($nome && $preco !== false && $preco > 0) {
        
        // Cria o carrinho se ele não existir
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adiciona o produto de forma limpa na sessão
        $_SESSION['carrinho'][] = [
            'nome' => $nome,
            'preco' => $preco
        ];

        // Altera a resposta para sucesso
        $resposta = [
            'sucesso' => true,
            'produto' => $nome,
            'mensagem' => 'Produto adicionado com sucesso!'
        ];
    } else {
        $resposta['mensagem'] = 'Dados do produto inválidos ou violados.';
    }
}

// Converte o array PHP em JSON e exibe na tela para o Fetch ler
echo json_encode($resposta);
exit();