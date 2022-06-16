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
    <section id="editPageAdm">
        <div class="containerEditPageAdm">
            <h1>Tela Administrativa</h1>
            <div class="submit2EditPageAdm">
                <button onclick="openWindow();">Voltar</button>
            </div>
            <div class="rowEditPageAdm">
                <form method="post" enctype="multipart/form-data">
                    <div class="formEditPageAdm">
                    <?php 
                        $stmt = $conn->prepare("SELECT * FROM site WHERE id_site = :id");
                        $stmt->execute(array(
                            ':id'	=> $_GET['id']
                        ));

                        foreach ($stmt as $row){
                            $linkWhatsapp = $row['link_instagram'];
                            $linkInstagram = $row['link_instagram'];
                            $endereco1 = $row['endereco1'];
                            $endereco2 = $row['endereco2'];
                            $sobreEmpresa = $row['sobre_empresa'];
                            $emailEmpresa = $row['email_empresa'];
                            $telEmpresa = $row['tel_empresa'];
                            $data = $row['data_edicao'];
                        }

                        if (isset($_SESSION['msg'])) {
                              echo $_SESSION['msg'];
                              unset($_SESSION['msg']);
                        }
                    ?>
                        <div class="inputEditPageAdm">
                            <input type="text" name="emailEmpresa" placeholder="Email da empresa" value="<?php echo $emailEmpresa; ?>">
                        </div>

                        <div class="input2EditPageAdm">
                            <input type="text" id="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" name="telEmpresa" placeholder="Telefone da Empresa" value="<?php echo $telEmpresa; ?>" >
                            <input type="date" name="dataEdicao" value="<?php echo $data ?>">
                        </div>

                        <div class="inputEditPageAdm">
                            <input type="text" name="linkInstagram" placeholder="@ do Instagram" value="<?php echo $linkInstagram; ?>">
                        </div>

                        <div class="input2EditPageAdm">
                            <input type="text" name="endereco1" placeholder="Endereço 1" value="<?php echo $endereco1; ?>">
                            <input type="text" name="endereco2" placeholder="Endereço 2" value="<?php echo $endereco2; ?>">
                        </div>

                        <div class="inputEditPageAdm">
                            <textarea name="sobreEmpresa" placeholder="sobre a empresa"><?php echo $sobreEmpresa; ?></textarea>
                        </div>

                        <div class="submitEnvPage">
                            <input type="submit" value="Editar"/>
                        </div>
                    </div>
                </form>
                <?php
                    if($_POST){
                        $stmt = $conn->prepare("UPDATE site SET link_whatsapp = :linkWhatsapp, link_instagram = :linkInstagram, endereco1 = :endereco1, 
                                                endereco2 = :endereco2, sobre_empresa = :sobreEmpresa, email_empresa = :email, tel_empresa = :telEmpresa, 
                                                data_edicao = :dataEdicao WHERE id_site = :id");
                        $stmt->execute(array(
                            ':linkWhatsapp' => 'https://api.whatsapp.com/send?l=pt-BR&phone=55'.$_POST['telEmpresa'],
                            ':linkInstagram' => 'https://www.instagram.com/'.$_POST['linkInstagram'],
                            ':endereco1' => $_POST['endereco1'],
                            ':endereco2' => $_POST['endereco2'],
                            ':sobreEmpresa' => $_POST['sobreEmpresa'],
                            ':email' => $_POST['emailEmpresa'],
                            ':telEmpresa' => $_POST['telEmpresa'],
                            'dataEdicao' => date("Y-m-d"),
                            ':id' => $_GET['id']
                        ));
                        if($stmt){
                            $_SESSION['msg'] = '<div class="messageRegisterPage"> <h2>Dados Alterados com sucesso!</h2> </div>';
                            header('Location: editPageAdm.php?id='.$_GET['id']);
                        }else{
                            $_SESSION['msg'] = '<div class="messageRegisterPage2"> <h2>Erro no envio de dados!</h2> </div>';
                            header('Location: editPageAdm.php?id='.$_GET['id']);
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