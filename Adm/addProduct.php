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
                            <input type="text" name="quantProduto" placeholder="Insira a quantidade de produtos disponíveis"/>
                            <input type="date" name="data" value='<?php echo date('Y-m-d'); ?>'/>
                        </div>

                        <div class="inputAdcPage2">
                            <input type="file" name="imagemProduto" />
                        </div>

                        <div class="submitAdcPage">
                            <input type="submit" value="Cadastrar"/>
                        </div>
                    </div>
                </form>
                <?php
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
                                $stmt = $conn->prepare("INSERT INTO produtos(id_produto, nome_produto, preco_produto, imagem_produto, quant_produto, data_publi) 
                                                        VALUES(NULL, :nome, :preco, :imagem, :quant, :dataPubli)");
                                $stmt->execute(array(
                                    ':nome'	=>$_POST['nomeProduto'],
                                    ':preco'	=>$_POST['precoProduto'],
                                    ':imagem'	=>$imagem_destino,
                                    ':quant'	=>$_POST['quantProduto'],
                                    ':dataPubli' =>date("Y-m-d H:i:s")
                                ));
                                $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Dados Enviados com sucesso!</h2> </div>';
                                header("Location: addProduct.php");

                            }else{
                                $_SESSION['msg'] = '<div class="messageRegisterPage2"> <h2>Erro no envio de dados!</h2> </div>';
                                header("Location: addProduct.php");
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