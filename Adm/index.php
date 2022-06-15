<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once("estrutura/head.php");
        session_start();
    ?>
</head>
<body>

    <section id="loginPage">
        <div class="containerLoginPage">
            <h1>WayneEnterprise</h1>
            <div class="rowLoginPage">
                <form method="post">
                    <div class="formLoginPage">
                        <div class="inputLoginPage">
                            <input type="text" name="email" placeholder="Email"/>
                        </div>

                        <div class="inputLoginPage">
                            <input type="password" name="senha" placeholder="Senha"/>
                        </div>
                    

                        <div class="submitLoginPage">
                            <input type="submit" value="Entrar"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
        if($_POST){
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email_user = :email AND senha_user = :senha AND adm = :adm");
            $stmt->execute(array(
                ':email' => $_POST['email'],
                ':senha' => $_POST['senha'],
                ':adm' => 1
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
                header("Location: home.php");
              }else{
                echo '<script>alert("OPS! Algo deu errado, verifique se possui uma conta ou verifique suas credenciais!")</script>';
              }
        }
    ?>
</body>
</html>