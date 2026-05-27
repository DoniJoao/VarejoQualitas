<?php
session_start();

// Verifica se o ID ou nome do produto foi enviado
if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    // Se o carrinho não existir na sessão, cria um array vazio
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adiciona o produto ao carrinho
    $_SESSION['carrinho'][] = [
        'nome' => $nome,
        'preco' => (float)$preco,
        'quantidade' => 1
    ];

    // Volta para a página de produtos
    header("Location: produtos.php");
    exit();
}

// Lógica para esvaziar o carrinho
if (isset($_GET['limpar'])) {
    unset($_SESSION['carrinho']);
    header("Location: carrinho.php");
    exit();
}
?>              