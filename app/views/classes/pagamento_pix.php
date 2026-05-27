<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Pix - Qualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center mt-5">
    <h2>Pagamento via Pix</h2>
    <p>
    Escaneie o QR Code abaixo para finalizar sua compra de 
    <strong>R$ 
        <?php
            $total = 0;
            if(isset($_SESSION['carrinho'])) {
                foreach($_SESSION['carrinho'] as $item) {
                    $total += $item['preco'];
                }
            }
            echo number_format($total, 2, ',', '.'); 
        ?>
    </strong>
</p>
    <img src="../img/qr-code-exemplo.png" alt="QR Code Pix" width="250">
    <div class="mt-4">
        <p>Após pagar, você receberá a confirmação por e-mail.</p>
        <a href="limpar_e_voltar.php" class="btn btn-primary">Voltar ao Início</a>
    </div>
</body>
</html>