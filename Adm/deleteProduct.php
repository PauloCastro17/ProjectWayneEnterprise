<?php
    include_once("./classes/connection.php");
    session_start();

    $stmt = $conn->prepare("DELETE FROM produtos WHERE id_produto = :id");
    $stmt->execute(array(
        ':id' => $_GET['id']
    ));
    if($stmt){
        $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Item excluido com sucesso!</h2> </div>';
        header('Location: home.php');
    }
    else{
        $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Falha na exlcusão do item</h2> </div>';
        header('Location: home.php');
    }

?>