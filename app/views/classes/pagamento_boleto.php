<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Boleto - Qualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center mt-5">
    <div class="container">
        <h2>Boleto Bancário</h2>
        <p>Seu boleto de <strong>R$ 
            <?php
                $total = 0;
                if(isset($_SESSION['carrinho'])) {
                    foreach($_SESSION['carrinho'] as $item) { $total += $item['preco']; }
                }
                echo number_format($total, 2, ',', '.'); 
            ?>
        </strong> foi gerado.</p>
        
        <div class="alert alert-warning d-inline-block p-4 my-3">
            <p class="mb-2">Código de barras para pagamento:</p>
            <code class="h5 text-dark">00190.00009 02345.678009 00000.123456 1 95430000015000</code>
        </div>
        
        <div class="mt-4">
            <button class="btn btn-outline-success me-2" onclick="window.print()">🖨️ Imprimir Boleto</button>
            <a href="limpar_e_voltar.php" class="btn btn-primary">✅ Finalizar e Voltar ao Início</a>
        </div>
    </div>
</body>
</html>