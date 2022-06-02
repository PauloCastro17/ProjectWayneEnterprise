<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once("estrutura/head.php");
        session_start();
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
                    <?php 
                        if (isset($_SESSION['msg'])) {
                              echo $_SESSION['msg'];
                              unset($_SESSION['msg']);
                        }
                   ?>
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
                $senha1 = $_POST['senha1'];
                $senha2 = $_POST['senha2'];
                $email = $_POST['email'];
                $nomeSobrenome = $_POST['nomeSobrenome'];
                    if($senha1 == $senha2 && $nomeSobrenome != "" && $email != ""){
                        $stmt = $conn->prepare('INSERT INTO clientes(id_cliente, nome_cliente, email_cliente, senha_cliente, adm) VALUES(NULL, :nome, :email, :senha, 0)');
                        $stmt->execute(array(
                            ':nome' => $nomeSobrenome,
                            ':email' => $email,
                            ':senha' => $senha1
                        ));
                        $_SESSION['msg'] = '<div class="messageRegisterPage"> <h1>Dados Enviados com sucesso</h1> </div>';
                        header("Location: registerPage.php");
                    }
                
                ?>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>