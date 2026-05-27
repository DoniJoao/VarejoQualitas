<?php
session_start();

// Lógica para ADICIONAR
if (isset($_POST['adicionar'])) {
    $item = [
        'nome' => $_POST['nome'],
        'preco' => (float)$_POST['preco']
    ];

    $_SESSION['carrinho'][] = $item;
    header("Location: carrinho.php"); // Leva o usuário direto para o carrinho para ele ver que funcionou
    exit();
}

// Lógica para REMOVER um item específico
if (isset($_GET['remover'])) {
    $index = $_GET['remover'];
    if (isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]);
        // Reorganiza os índices do array para não quebrar o loop
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }
    header("Location: carrinho.php");
    exit();
}