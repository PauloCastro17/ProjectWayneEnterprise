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
    <section id="loginPage">
        <div class="containerLoginPage">
            <div class="rowLoginPage">
                <form method="post">
                    <div class="formLoginPage">
                    <?php 
                        if (isset($_SESSION['msg'])) {
                              echo $_SESSION['msg'];
                              unset($_SESSION['msg']);
                        }
                   ?>
                        <div class="inputLoginPage">
                            <input type="text" name="email" placeholder="Email"/>
                        </div>

                        <div class="inputLoginPage">
                            <input type="password" name="senha" placeholder="Senha"/>
                        </div>
                    
                        <span>Não possui uma conta ainda? <a href="./registerPage.php">Clique aqui para criar</a></span>

                        <div class="submitLoginPage">
                            <input type="submit" value="Entrar"/>
                        </div>
                    </div>
                </form>
                <?php
                        if($_POST){
                            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email_user = :email AND senha_user = :senha AND adm = :adm");
                            $stmt->execute(array(
                                ':email' => $_POST['email'],
                                ':senha' => $_POST['senha'],
                                ':adm' => 0
                            ));
                            $resultado = $stmt->fetchAll();
                
                            $logado = false;
                            $_SESSION['online'] = 0;
                            foreach($resultado as $item){
                                $logado = true;
                                $_SESSION['online'] = 1;
                                $_SESSION['id'] = $item['id_user'];
                                $_SESSION['nome'] = $item['nome_user'];
                                $_SESSION['email'] = $item['email_user'];
                                $_SESSION['adm'] = $item['adm'];
                            }
                            if($logado){
                                header("Location: index.php");
                              }else{
                                $_SESSION['msg'] = '<div class="messageRegisterPage2"> <h2>Algum dado não corresponde!</h2> </div>';
                                header('Location: loginPage.php');
                              }
                        }
                ?>
            </div>
        </div>
    </section>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>