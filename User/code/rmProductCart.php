<?php
    include_once("../classes/connection.php");
    session_start();

    $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id_user AND id_carrinho = :id");
    $stmt->execute(array(
        ':id_user' => $_SESSION['id'],
        ':id' => $_GET['id']
    ));
    foreach ($stmt as $row) {
        $preco = $row['preco_produto'];
    }

    $stmt = $conn->prepare("UPDATE carrinho SET quant_produto = (quant_produto - :quant), total = (total - :preco) WHERE id_carrinho = :id");
    $stmt->execute(array(
        ':quant' => 1,
        ':id' => $_GET['id'],
        ':preco' => $preco
    ));
    header('Location: ../shoppingCart.php');

    $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id_user AND id_carrinho = :id");
    $stmt->execute(array(
        ':id_user' => $_SESSION['id'],
        ':id' => $_GET['id']
    ));

    foreach ($stmt as $row) {
        $quant_produto = $row['quant_produto'];
    }
    if($quant_produto == 0){
        $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_carrinho = :id");
        $stmt->execute(array(
            ':id' => $_GET['id']
        ));
    }else{
        header('Location: ../shoppingCart.php');
    }

?>