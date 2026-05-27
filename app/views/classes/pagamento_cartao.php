<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cartão de Crédito - Qualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light mt-5">
    <div class="container" style="max-width: 450px;">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Cartão de Crédito</h2>
            <p class="text-center">Total a pagar: <strong>R$ 
                <?php
                    $total = 0;
                    if(isset($_SESSION['carrinho'])) {
                        foreach($_SESSION['carrinho'] as $item) { $total += $item['preco']; }
                    }
                    echo number_format($total, 2, ',', '.'); 
                ?>
            </strong></p>
            
            <form>
                <div class="mb-3">
                    <label class="form-label">Número do Cartão</label>
                    <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Validade</label>
                        <input type="text" class="form-control" placeholder="MM/AA">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-control" placeholder="123">
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <!-- Note que o link agora parece um botão grande de confirmação -->
                    <a href="limpar_e_voltar.php" class="btn btn-primary btn-lg">💳 Confirmar Pagamento</a>
                    <a href="finalizar.php" class="btn btn-link btn-sm text-muted">Cancelar e Voltar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>