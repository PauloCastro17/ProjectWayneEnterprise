<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php")
?>
<body>
<?php
    include_once("./estrutura/header.php")
?>

<section id="shoppingCart">
    <div class="containerShoppingCart">
        <h1>Carrinho de Compras</h1>
        <div class="rowShoppingCart">
            <div class="productShoppingCart">
                <img src="./assets/imageCamisa.png">
                <div class="legendaShoppinCart">
                    <h2>Camisa 1</h2>
                        <div class="legenda2ShoppingCart">
                            <p>R$ 60.00</p>
                            <p>Quantidade: 1</p>
                        </div>
                        <div class="legenda2ShoppingCart">
                            <i class="fa-solid fa-minus"></i>
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
            </div>

            
            <div class="rowFrete">
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
            </div>
        </div>


    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>