<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - VarejoQualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active d-flex align-items-center gap-2" href="/VarejoQualitas/index.html">
                <span>🏠</span> Página Inicial
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/VarejoQualitas/app/views/classes/produtos.php">
                <img src="/VarejoQualitas/app/views/img/produto.png" alt="Produtos" width="50">Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/VarejoQualitas/app/views/classes/contato.html">
                <img src="/VarejoQualitas/app/views/img/telefone.png" alt="Contato" width="50">Contato</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/VarejoQualitas/app/views/classes/carrinho.php">
                <img src="/VarejoQualitas/app/views/img/carrinho.png" alt="Carrinho" width="50">Carrinho</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<body>
    <!-- Importe sua Navbar aqui depois -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Seu Carrinho</h2>
        
        <?php if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0): ?>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['carrinho'] as $index => $item): 
                        $total += $item['preco'];
                    ?>
                        <tr>
                            <td><?php echo $item['nome']; ?></td>
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="carrinho_acoes.php?remover=<?php echo $index; ?>" class="btn btn-sm btn-danger">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <td class="fw-bold">TOTAL</td>
                        <td class="fw-bold" colspan="2">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-between">
                <a href="produtos.php" class="btn btn-outline-primary">Continuar Comprando</a>
                <a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Seu carrinho está vazio! <br>
                <a href="produtos.php" class="alert-link">Clique aqui para ver nossos produtos.</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>