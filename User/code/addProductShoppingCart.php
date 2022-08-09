<?php
        include_once("../classes/connection.php");
        session_start();
        if(!isset($_SESSION['id'])){
            header('Location: ../loginPage.php');
        }

        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id_produto = :id ");
        $stmt->execute(array(
            ':id' => $_GET['id']
        ));
        foreach ($stmt as $row) {
            $precoProduto = $row['preco_produto'];
        }

        $stmt = $conn->prepare("SELECT * FROM carrinho WHERE fk_id_produto = :id AND fk_id_user = :id_user");
        $stmt->execute(array(
            ':id' => $_GET['id'],
            ':id_user' => $_SESSION['id']
        ));
        foreach ($stmt as $row) {
            $idProduto = $row['fk_id_produto'];
        }

        if($idProduto == $_GET['id']){
            $stmt = $conn->prepare("UPDATE carrinho SET quant_produto = (:quant + quant_produto), total = (quant_produto * :total) WHERE fk_id_produto = :id");
            
            $stmt->execute(array(
                ':quant' => 1,
                ':id' => $_GET['id'],
                ':total' => $precoProduto
            ));
            header("Location: ../shoppingCart.php");
        }else{
            $stmt = $conn->prepare("INSERT INTO carrinho(id_carrinho, fk_id_user, fk_id_produto, quant_produto, total) 
            VALUES(NULL, :id_user, :id_produto, :quant, :total)");

            $stmt->execute(array(
            ':id_user' => $_SESSION['id'],
            ':id_produto' => $_GET['id'],
            ':quant' => 1,
            ':total' => $precoProduto
            ));

            header("Location: ../shoppingCart.php");
        }


?>