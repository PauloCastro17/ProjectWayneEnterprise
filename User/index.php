<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php")
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
                <div class="produtoHome">
                    <img src="./assets/images/imageCamisa.png">
                    <div class="legendaProdutoHome">
                        <h2>Camisa 1</h2>
                        <p>R$ 60.00</p>
                        <a><button>Adicionar</button></a>
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