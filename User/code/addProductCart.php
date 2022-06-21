<?php
    include_once("../classes/connection.php");
    
    session_start();

    $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id_user AND id_carrinho = :id");
    $stmt->execute(array(
        ':id_user' => $_SESSION['id'],
        ':id' => $_GET['id']
    ));

    foreach ($stmt as $row) {
        $quant_produto = $row['quant_produto'];
        $precoProduto = $row['preco_produto'];
    }
    echo $quant_produto;

    $stmt = $conn->prepare("UPDATE carrinho SET quant_produto = (:quant + quant_produto), total = (quant_produto * :total) WHERE id_carrinho = :id");
    $stmt->execute(array(
        ':quant' => 1,
        ':id' => $_GET['id'],
        ':total' => $precoProduto
    ));
    header('Location: ../shoppingCart.php');

?>