<?php
session_start();
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
    header("Location: produtos.php");
    exit();
}

$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra - Qualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Resumo do Pedido</h2>
                <hr>
                <ul class="list-group list-group-flush mb-4">
                    <?php foreach ($_SESSION['carrinho'] as $item): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <?php echo $item['nome']; ?>
                            <span>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between fw-bold bg-light">
                        TOTAL <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </li>
                </ul>

                <form action="processar_pedido.php" method="POST">
                    <h4>Dados de Entrega</h4>
                    <div class="mb-3">
                        <label class="form-label">Endereço Completo</label>
                        <input type="text" name="endereco" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <select name="pagamento" class="form-select">
                            <option value="pix">Pix</option>
                            <option value="boleto">Boleto</option>
                            <option value="cartao">Cartão de Crédito</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Confirmar Pedido</button>
                        <a href="carrinho.php" class="btn btn-link">Voltar ao Carrinho</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>