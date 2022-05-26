<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once("estrutura/head.php")
    ?>
</head>
<body>
    <?php
        include_once("estrutura/header.php")
    ?>
    <section id="registerPage">
        <div class="containerRegisterPage">
            <div class="rowRegisterPage">
                <form method="post">
                    <div class="formRegisterPage">
                        <div class="inputRegisterPage">
                            <input type="text" name="nomeSobrenome" placeholder="Insira seu nome e sobrenome"/>
                        </div>

                        <div class="inputRegisterPage">
                            <input type="text" name="email" placeholder="Insira um email"/>
                        </div>

                        <div class="inputRegisterPage2">
                            <input type="text" name="senha1" placeholder="Crie uma senha"/>
                            <input type="text" name="senha2" placeholder="Repita a mesma senha anterior"/>
                        </div>

                        <span>Já possui conta? <a href="./loginPage.php">Clique aqui</a></span>

                        <div class="submitRegisterPage">
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