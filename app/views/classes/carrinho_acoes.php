<?php
session_start();

// 1. ANTES DE TUDO: Verifica se é um pedido de remoção via link (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['remover'])) {
    $index = filter_input(INPUT_GET, 'remover', FILTER_VALIDATE_INT);

    if ($index !== false && isset($_SESSION['carrinho'][$index])) {
        // Remove o item específico do array do carrinho
        unset($_SESSION['carrinho'][$index]);
        
        // Reorganiza os índices do array para não quebrar o loop do foreach
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }

    // Redireciona de volta para a página do carrinho instantaneamente!
    header("Location: carrinho.php");
    exit();
}

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