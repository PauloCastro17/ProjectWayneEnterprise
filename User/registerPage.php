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
                            <input type="password" name="senha1" placeholder="Crie uma senha"/>
                            <input type="password" name="senha2" placeholder="Repita a mesma senha anterior"/>
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
                    if($_POST){
                        if($_POST['senha1'] == $_POST['senha2']){ 
                            $stmt =$conn->prepare("INSERT INTO usuarios(id_user, nome_user, email_user, senha_user, adm) 
                                                VALUES(NULL, :nome, :email, :senha, :adm)");
                            $stmt->execute(array(
                                ':nome'	=> $_POST['nomeSobrenome'],
                                ':email'	=> $_POST['email'],
                                ':senha'	=> $_POST['senha1'],
                                ':adm'	=> 0
                            ));
                            if($stmt){
                                $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Dados Enviados com sucesso!</h2> </div>';
                                header('Location: registerPage.php');
                            }else{
                                $_SESSION['msg'] = '<div class="messageRegisterPage2"> <h2>Erro no envio de dados!</h2> </div>';
                                header('Location: registerPage.php');
                            }
                        }
                    }
                
                ?>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>