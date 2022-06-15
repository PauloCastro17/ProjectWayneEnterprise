<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    session_start();
?>
<body>
<?php
    include_once("./estrutura/header.php");
?>

<section id="products">
    <div class="containerProducts">
        <h1>Todos os Produtos</h1>
        <a href="./addProduct.php"><button id="buttonAdcHome">Adicionar Produto</button></a>
        <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        
        ?>
        <div class="rowProducts">
            <div class="produtosProducts">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM produtos");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll();

                    foreach ($resultado as $item){
                        echo '<div class="produtoProducts">
                            <img src='.$item['imagem_produto'].'>
                        <div class="legendaProdutoProducts">
                            <h2>'.$item['nome_produto'].'</h2>
                            <a href="./editPage.php?id='.$item["id_produto"].'"><button id="buttonEditHome">Editar</button></a>
                            <a href="./deleteProduct.php?id='.$item["id_produto"].'"><button id="buttonDelHome">Deletar</button></a>
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