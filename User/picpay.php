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
        include_once("estrutura/header.php");

        $stmt = $conn->prepare("SELECT * FROM carrinho WHERE fk_id_user = :id");
        $stmt->execute(array(
            ':id' => $_SESSION['id']
        ));
        foreach ($stmt as $row) {
            $total = $row['total'];
        }
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
                        <div class="inputRegisterPage2">
                            <input type="text" name="firstName" placeholder="Primeiro Nome"/>
                            <input type="text" name="lastName" placeholder="Sobrenome"/>
                        </div>

                        <div class="inputRegisterPage">
                            <input type="text" name="email" placeholder="Insira seu email"/>
                        </div>

                        <div class="inputRegisterPage2">
                            <input type="text" class="cpfOuCnpj" placeholder="XXX.XXX.XXX-XX" name="cpf"/>
                            <input type="text" id="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" name="telefone" placeholder="TELEFONE"/>
                        </div>


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
                        $stmt = $conn->prepare("INSERT INTO pagamento(id_pagamento, user_id, data_vencimento, valor) VALUES(:id_pagamento, :user, :data_vencimento, :valor)");
                        $stmt->execute(array(
                            ':id_pagamento' => rand(1000,9999),
                            ':user' => $_SESSION['id'],
                            'data_vencimento' => date("Y-m-d", strtotime('+3days')),
                            ':valor' => $total
                        ));
                    }
                    if($stmt -> rowCount()){
                        $TokenPicPay = 'e78c10be-8367-40c7-aaa4-60c9b70f655c';
                        $stmt = $conn->prepare('SELECT * FROM pagamento, usuarios WHERE `id_user` = '.$_SESSION['id'].' AND `user_id` = '.$_SESSION['id'].'');
                        $stmt->execute();
                        foreach($stmt as $row){}

                        $DadosCompra = [
                            "referenceId" => $row['id'],
                            "callbackUrl" => "http://localhost/WayneEnterprise/User/callback",
                            "returnUrl" => "http://localhost/WayneEnterprise/User/cliente/pedido/".$row['id'],
                            "value" => (double) $row['valor'],
                            "expiresAt" => $row['data_vencimento'],
                            "channel" => "my-channel",
                            "purchaseMode" => "in-store",
                            "buyer" => [
                              "firstName" => $_POST['firtsname'],
                              "lastName" => $_POST['lastname'],
                              "document" => $_POST['cpf'],
                              "email" => $_POST['email'],
                              "phone" => $_POST['telefone']
                            ]
                            ];

                            $ch = curl_init();

    //URL de local de pagamento
    curl_setopt($ch, CURLOPT_URL, 'https://appws.picpay.com/ecommerce/public/payments');

    //verificar transferência
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //SSL verificação
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    //dados comnpra
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($DadosCompra));
    //Enviar Headers
    $headers = [];
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'x-picpay-token:'.$TokenPicPay;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //fazer requisição
    $result = curl_exec($ch);

    //fechar
    curl_close($ch);

    $DadosResultado = json_decode($result);
    if(isset($DadosResultado->errors)){
        echo '<script>alert("Erro!");</script>';
    }else{
        $stmt = $conn->prepare("UPDATE pagamento SET referenceID = :referenceId, qrcode = :qrcode, paymentUrl = :payment WHERE `user_id` = :id");
        $stmt->execute(array(
            'referenceid' => $DadosResultado->referenceId,
            ':qrcode' => $DadosResultado->qrcode->base64,
            ':payment' => $DadosResultado->paymentUrl,
            ':id' => $_SESSION['id']
        ));
       header("Location: StatusPicPay.php?id=".$DadosResultado->referenceId);
    }
        
                }
                
            ?>
                ?>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>