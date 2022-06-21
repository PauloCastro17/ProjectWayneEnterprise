<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    include_once("./classes/connection.php");
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: loginPage.php');
    }
    $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id_user ");
    $stmt->execute(array(
        ':id_user' => $_SESSION['id']
    ));
    foreach ($stmt as $row){
        $quant = $row['quant_produto'];
    }
?>
<body>
<?php
    include_once("./estrutura/header.php")
?>

<section id="shoppingCart">
    <div class="containerShoppingCart">
        <h1>Carrinho de Compras</h1>
        <?php
            if($quant >= 1){
        ?>
        <div class="btnCompra">
            <a href="./api/mercadoPago/pagamento.php"><button>Finalizar Compra</button></a>
        </div>
        <?php } ?>
        <div class="rowShoppingCart">
        <div class="produtosShoppinCart">
        <?php
                $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id_user ");
                $stmt->execute(array(
                    ':id_user' => $_SESSION['id']
                ));
                foreach ($stmt as $row){
                    if($row['quant_produto'] >= 1){
                        echo '
                        <div class="productShoppingCart">
                        <img src="'.$row['imagem_produto'].'">
                        <div class="legendaShoppinCart">
                            <h2>'.$row['nome_produto'].'</h2>
                            <div class="legenda2ShoppingCart">
                                <p>R$ '.$row['preco_produto'].'</p>
                                <p>Quantidade: '.$row['quant_produto'].'</p>
                            </div>
                            <div class="legenda2ShoppingCart">
                                <a href="./code/rmProductCart.php?id='.$row['id_carrinho'].'"><i class="fa-solid fa-minus"></i></a>
                                <a href="./code/addProductCart.php?id='.$row['id_carrinho'].'"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>';
                    }else{
                        echo '<h1>teste</h1>';
                    }
                }
        ?>
            </div>
          <!--  <div class="rowFrete">
                <div class="freteShoppingCart">
                    <p>Calcular Frete</p>
                    <div class="inputFrete">
                        <input type="text" placeholder="XXXXX-XXX">
                        <button type="submit"> Calcular </button>
                    </div>
                </div>

                <div class="resultFreteShoppingCart">
                    <div>
                        <i class="fa-solid fa-location-dot"> Rua fulano de tal</i>
                    </div>
                    <hr>
                    <div class="resultFreteShoppingCartLegenda">
                        <i class="fa-solid fa-truck"></i>
                        <p>Receba até 17/09</p>
                        <p>R$ 60.00</p>
                    </div>

                    <div class="resultFreteShoppingCartLegenda">
                        <i class="fa-solid fa-truck"></i>
                        <p>Receba até 17/09</p>
                        <p>R$ 60.00</p>
                    </div>
                </div>
            </div> -->
        </div>


    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>