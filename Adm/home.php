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
        <div class="rowProducts">
            <div class="produtosProducts">
                <div class="produtoProducts">
                    <img src="./assets/imageCamisa.png">
                    <div class="legendaProdutoProducts">
                        <h2>Camisa 1</h2>
                        <a><button id="buttonEditHome">Editar</button></a>
                        <a><button id="buttonDelHome">Deletar</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>