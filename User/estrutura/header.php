    <?php
        include_once("./classes/connection.php");

        $stmt = $conn->prepare("SELECT * FROM site");
        $stmt->execute();

        foreach ($stmt as $row){
            $linkWhatsapp = $row['link_whatsapp'];
            $linkInstagram = $row['link_instagram'];
            $endereco1 = $row['endereco1'];
            $endereco2 = $row['endereco2'];
            $sobreEmpresa = $row['sobre_empresa'];
            $emailEmpresa = $row['email_empresa'];
            $telEmpresa = $row['tel_empresa'];
        }

    ?>
    <header>
        <div class="header">
            <h1>WayneEnterprise</h1>

            <ul class="headerLinks">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./produtos.php">Produtos</a></li>
                <li><a href="sobreNos.php">Sobre nós</a></li>
                <li><a href="contateNos.php">Contate-nos</a></li>
                <?php
                    if(isset($_SESSION['id'])){
                        echo '<li><a href="shoppingCart.php">Carrinho</a></li>';
                    }
                ?>
            </ul>
        </div>
    </header>



