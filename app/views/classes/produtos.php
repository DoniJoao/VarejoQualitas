<?php
session_start();

// Define a raiz do projeto para não errar os requires
$root = $_SERVER['DOCUMENT_ROOT'] . '/VarejoQualitas';
require_once $root . '/config/Connection.php';
require_once $root . '/app/models/ProdutoDAO.php';

// Inicializa a conexão e o DAO
$database = new Connection();
$db = $database->getConn();
$produtoDAO = new \app\models\ProdutoDAO($db);

// Busca os produtos direto do Banco VarejoQualitas
$produtos = $produtoDAO->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="João Pedro Doni" />
    <meta name="keywords" content="Qualitas,qualitas,Ventilação,ventilação,Ventiladores,ventiladores,Industria,industria" />
    <meta
      name="description"
      content="Ventiladores Domesticos direto de Fabrica"
    />
    <link rel="icon" href="/VarejoQualitas/app/views/img/favicon-32x32.png" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
<body>
    <header class="header text-center py-3">
      <h1>Qualitas</h1>
      <h3>Produtos em Estoque</h3>
    </header>
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
              <a class="nav-link" href="/VarejoQualitas/index.html">
                <img src="/VarejoQualitas/app/views/img/icon_home.png" alt="Home" width="50">Página Inicial</a>
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
    <title>Nossos Produtos</title>
    <style>
        .produto {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .produto h3 {
            margin-bottom: 10px;
        }
        .produto p {
            font-size: 18px;
            font-weight: bold;
        }
        .produto img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .add-carrinho {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-carrinho:hover {
            background-color: #0056b3;
        }
    </style>

<div class="container">
    <h2 class="text-center my-4">Nossos Produtos</h2>
    <div class="row">

    <?php if (count($produtos) > 0): ?>
        <?php foreach ($produtos as $produto): ?>
            <div class='col-md-4'>
                <div class='produto shadow-sm'>
                    <!-- Imagem dinâmica vinda do banco -->
                    <img src='<?php echo $produto['imagem']; ?>' alt='<?php echo $produto['nome']; ?>'> 
                    <h3><?php echo $produto['nome']; ?></h3>
                    <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    
                    <!-- Formulário que envia os dados para o carrinho de forma segura -->
                    <form method='POST' action='carrinho_acoes.php'>
                        <input type='hidden' name='nome' value='<?php echo $produto['nome']; ?>'>
                        <input type='hidden' name='preco' value='<?php echo $produto['preco']; ?>'>
                        <button type='submit' name='adicionar' class='add-carrinho'>Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Nenhum produto cadastrado no momento.</p>
    <?php endif; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
</body>
</html>
