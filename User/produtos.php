<!DOCTYPE html>
<html lang="en">
<?php
        include_once("estrutura/head.php");
        session_start();
?>
<body>
<?php
    include_once("./estrutura/header.php")
?>

<section id="products">
    <div class="containerProducts">
        <h1>Todos os Produtos</h1>
        <div class="rowProducts">
            <div class="produtosProducts">
            <?php
                    $stmt = $conn->prepare("SELECT * FROM produtos");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll();
                    foreach ($resultado as $row){
                        echo '<div class="produtoProducts">
                        <img src="'.$row['imagem_produto'].'">
                        <div class="legendaProdutoProducts">
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