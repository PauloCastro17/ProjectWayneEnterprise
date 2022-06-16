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
                <button onclick="openWindow();">Voltar</button>
            </div>
            <div class="rowAdcPage">
                <form method="post" enctype="multipart/form-data">
                    <div class="formAdcPage">
                    <?php 
                        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id_produto = :id");
                        $stmt->execute(array(
                            ':id'	=> $_GET['id']
                        ));

                        foreach ($stmt as $row){
                            $nomeProduto = $row['nome_produto'];
                            $precoProduto = $row['preco_produto'];
                            $imagemProduto = $row['imagem_produto'];
                            $quantProduto = $row['quant_produto'];
                            $dataPubli = $row['data_publi'];
                        }

                        if (isset($_SESSION['msg'])) {
                              echo $_SESSION['msg'];
                              unset($_SESSION['msg']);
                        }
                   ?>
                        <div class="inputAdcPage">
                            <input type="text" name="nomeProduto" placeholder="Insira o nome do produto" value="<?php echo $nomeProduto; ?>"/>
                            <input type="text" name="precoProduto" placeholder="Insira o preço do produto" value="<?php echo $precoProduto; ?>"/>
                        </div>

                        <div class="inputAdcPage">
                            <input type="text" name="quantProduto" placeholder="Insira a quantidade de produtos disponíveis" value="<?php echo $quantProduto; ?>"/>
                            <input type="date" name="data" value='<?php echo $dataPubli; ?>'/>
                        </div>

                        <div class="inputAdcPage2">
                            <img style="width: 250px;" src="<?php echo $imagemProduto; ?>">
                        </div>
                        <div class="inputAdcPage2">
                            <input type="file" name="imagemProduto" />
                        </div>

                        <div class="submitEnvPage">
                            <input type="submit" value="Editar"/>
                        </div>
                    </div>
                </form>
                <?php
                if($_POST){
                    if((isset($_FILES['imagemProduto']['name']) && $_FILES["imagemProduto"]["error"] == 0))
                    {
                
                        $imagem_tmp = $_FILES['imagemProduto']['tmp_name'];
                        $imagem_nome = $_FILES['imagemProduto']['name'];
                
                
                    // Pega a extensao
                        $imagem_extensao = strrchr($imagem_nome, '.');
                
                    // Converte a extensao para mimusculo
                        $imagem_extensao = strtolower($imagem_extensao);
                
                
                        $imagem_novoNome = md5(microtime()) . $imagem_extensao;
                
                        // Concatena a pasta com o nome
                        $imagem_destino = '../Adm/assets/uploads/' . $imagem_novoNome;
                
                        // tenta mover o arquivo para o destino
                        if(( @move_uploaded_file( $imagem_tmp, $imagem_destino  )))
                        {
                            $stmt = $conn->prepare("UPDATE produtos SET nome_produto = :nome, preco_produto = :preco, imagem_produto = :imagem, quant_produto = :quant, data_publi = :dataPubli WHERE id_produto = :id");
                            $stmt->execute(array(
                                ':nome'	=>$_POST['nomeProduto'],
                                ':preco'	=>$_POST['precoProduto'],
                                ':imagem'	=>$imagem_destino,
                                ':quant'	=>$_POST['quantProduto'],
                                ':dataPubli' =>date("Y-m-d H:i:s"),
                                'id' => $_GET['id']
                            ));
                            $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Dados Alterados com sucesso!</h2> </div>';
                            header('Location: editPage.php?id='.$_GET['id']);

                        }else{
                            $_SESSION['msg'] = '<div class="messageRegisterPage2"> <h2>Erro no envio de dados!</h2> </div>';
                            header('Location: editPage.php?id='.$_GET['id']);
                        }
                    }else{
                        $stmt = $conn->prepare("UPDATE produtos SET nome_produto = :nome, preco_produto = :preco, quant_produto = :quant, data_publi = :dataPubli WHERE id_produto = :id");
                        $stmt->execute(array(
                            ':nome'	=>$_POST['nomeProduto'],
                            ':preco'	=>$_POST['precoProduto'],
                            ':quant'	=>$_POST['quantProduto'],
                            ':dataPubli' =>date("Y-m-d H:i:s"),
                            'id' => $_GET['id']
                        ));
                        $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Dados Alterados com sucesso!</h2> </div>';
                        header('Location: editPage.php?id='.$_GET['id']);
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
        include_once("estrutura/footer.php");
    ?>
</body>
</html>