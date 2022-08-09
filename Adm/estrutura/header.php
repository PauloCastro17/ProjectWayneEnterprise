    <header>
        <div class="header">
            <h1>WayneEnterprise</h1>
            <?php
                $stmt = $conn->prepare("SELECT * FROM site");
                $stmt->execute();
                foreach ($stmt as $row) {
                    $idEmpresa = $row['id_site'];
                }

                $stmt2 = $conn->prepare("SELECT count(id_pagamento) FROM pagamento");
                $stmt2->execute();

                foreach ($stmt2 as $row){
                    $valorRegistro = $row[0];
                }
            ?>

            <ul class="headerLinks">
                <li><a href="./home.php">Home</a></li>
                <li><a href="./editPageAdm.php?id=<?php echo $idEmpresa; ?>">Tela Administrativa</a></li>
                <li><a href="./registerFunc.php">Novo Funcionário</a></li>
                <li id="ultimasCompras"><a href="./ultimasCompras.php">Últimas Compras<span><?php echo $valorRegistro; ?></span></a> </li>
                <li><a href="./sair.php">Sair</a></li>
            </ul>
        </div>
    </header>
<?php
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }

    if (empty($_SESSION)) session_start();

    if (empty($_SESSION['lastAccess'])) $_SESSION['lastAccess'] = time();
    else {
        $_SESSION['lastAccess'] -= time();
    }

    if ($_SESSION['lastAccess'] > time()+5) {
        session_destroy();
        echo('session timeout');
    }

?>
