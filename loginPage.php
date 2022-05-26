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
    <section id="loginPage">
        <div class="containerLoginPage">
            <div class="rowLoginPage">
                <form method="post">
                    <div class="formLoginPage">
                        <div class="inputLoginPage">
                            <input type="text" name="nomeSobrenome" placeholder="Insira seu nome e sobrenome"/>
                        </div>

                        <div class="inputLoginPage">
                            <input type="text" name="email" placeholder="Insira um email"/>
                        </div>
                    
                        <span>Já possui conta? <a href="./loginPage.php">Clique aqui</a></span>

                        <div class="submitLoginPage">
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