<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $metodo = $_POST['pagamento'];

    switch ($metodo) {
        case 'pix':
            header("Location: pagamento_pix.php");
            break;
        case 'boleto':
            header("Location: pagamento_boleto.php");
            break;
        case 'cartao':
            header("Location: pagamento_cartao.php");
            break;
        default:
            header("Location: finalizar.php");
            break;
    }
    exit();
}