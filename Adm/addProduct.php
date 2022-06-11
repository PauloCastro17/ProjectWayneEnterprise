<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once("estrutura/head.php");
        session_start();
    ?>
    <script>
        function openWindow(){
            window.location.href="./home.php"
        }
    </script>
</head>
<body>
    <?php
        include_once("estrutura/header.php")
    ?>
    <section id="adcPage">
        <div class="containerAdcPage">
            <h1>Adicionar Produto</h1>
            <div class="submit2AdcPage">
                <button onclick="openWindow();">Cancelar</button>
            </div>
            <div class="rowAdcPage">
                <form method="post">
                    <div class="formAdcPage">
                    <?php 
                        if (isset($_SESSION['msg'])) {
                              echo $_SESSION['msg'];
                              unset($_SESSION['msg']);
                        }
                   ?>
                        <div class="inputAdcPage">
                            <input type="text" name="nomeProduto" placeholder="Insira o nome do produto"/>
                            <input type="text" name="precoProduto" placeholder="Insira o preço do produto"/>
                        </div>

                        <div class="inputAdcPage">
                            <input type="text" name="nomeProduto" placeholder="Insira o nome do produto"/>
                            <input type="date" name="data"/>
                        </div>

                        <div class="inputAdcPage2">
                            <input type="file" name="nomeProduto" placeholder="Insira o nome do produto"/>
                        </div>

                        <div class="submitAdcPage">
                            <input type="submit" value="Cadastrar"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>