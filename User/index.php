<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    include_once("./classes/connection.php");
    session_start();
?>
<body>
<?php
    include_once("./estrutura/header.php")
?>

<section id="home">
    <div class="containerHome">
        <h1>Últimos itens adicionados</h1>
        <div class="rowHome">
            <div class="produtosHome">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM produtos LIMIT 6");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll();
                    foreach ($resultado as $row){
                        echo '<div class="produtoHome">
                        <img src='.$row['imagem_produto'].'>
                        <div class="legendaProdutoHome">
                            <h2>'.$row['nome_produto'].'</h2>
                            <p>R$ '.$row['preco_produto'].'</p>
                            <a href="./code/addProductShoppingCart.php?id='.$row['id_produto'].'"><button>Adicionar</button></a>
                        </div>
                    </div>';
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>