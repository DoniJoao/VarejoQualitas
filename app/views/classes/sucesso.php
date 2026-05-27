<?php
session_start();
unset($_SESSION['carrinho']); // Limpa o carrinho
?>
<h1>Compra Finalizada!</h1>
<p>Obrigado por comprar na Qualitas.</p>
<a href="../../index.html">Voltar para a Home</a>