<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once("estrutura/head.php");
        include_once("classes/connection.php");
        session_start();

        $stmt2 = $conn->prepare('SELECT SUM(total) FROM carrinho WHERE fk_id_user = '.$_SESSION['id'].'');
        $stmt2->execute();

        foreach ($stmt2 as $row){
            $total = number_format($row[0], 2);
        }
        
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
                        <div class="inputRegisterPage2">
                            <input type="text" name="firstName" placeholder="Nome"/>
                            <input type="text" name="lastName" placeholder="Sobrenome"/>
                        </div>

                        <div class="inputRegisterPage">
                            <input type="text" name="email" placeholder="Insira um email"/>
                        </div>

                        <div class="inputRegisterPage2">
                            <input type="text" name="document" placeholder="CPF"/>
                            <input type="text" name="telefone" placeholder="Telefone"/>
                        </div>

                        <div class="submitRegisterPage">
                            <input type="submit" value="Enviar Dados"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
                    if($_POST){
                        $idPagamento = rand(1000,9999);


                        $stmt = $conn->prepare("INSERT INTO pagamento(id_pagamento, user_id, data, data_vencimento, valor) VALUES(:id, :id_user, :data, :data_vencimento, :valor)");
                        $stmt->execute(array(
                            ':id' => $idPagamento,
                            ':id_user' => $_SESSION['id'],
                            ':data' => date("Y-m-d"),
                            ':data_vencimento' => date("Y-m-d", strtotime('+1days')),
                            ':valor' => $total
                        ));

                        $stmt = $conn->prepare("INSERT INTO backup(id_backup, user_id, data, data_vencimento, valor) VALUES(:id, :id_user, :data, :data_vencimento, :valor)");
                        $stmt->execute(array(
                            ':id' => $idPagamento,
                            ':id_user' => $_SESSION['id'],
                            ':data' => date("Y-m-d"),
                            ':data_vencimento' => date("Y-m-d", strtotime('+1days')),
                            ':valor' => $total
                        ));

                        if($stmt -> rowCount()){
                            $TokenPicPay = 'e78c10be-8367-40c7-aaa4-60c9b70f655c';
                            $stmt = $conn->prepare('SELECT * FROM pagamento, usuarios WHERE `id_user` = '.$_SESSION['id'].' AND `user_id` = '.$_SESSION['id'].'');
                            $stmt->execute();
                            foreach($stmt as $row){}

                            $DadosCompra = [
                                "referenceId" => $row['id_pagamento'],
                                "callbackUrl" => "http://localhost/WayneEnterprise/User/callback",
                                "returnUrl" => "http://localhost/WayneEnterprise/User/cliente/pedido/".$row['id_pagamento'],
                                "value" => $total,
                                "expiresAt" => $row['data_vencimento'],
                                "channel" => "my-channel",
                                "purchaseMode" => "in-store",
                                "buyer" => [
                                "firstName" => $_POST['firstName'],
                                "lastName" => $_POST['lastName'],
                                "document" => $_POST['document'],
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
            $stmt = $conn->prepare("UPDATE pagamento SET referenceId = :referenceid, qrcode = :qrcode, paymentUrl = :payment WHERE `user_id` = :id");
            $stmt->execute(array(
                ':referenceid' => $DadosResultado->referenceId,
                ':qrcode' => $DadosResultado->qrcode->base64,
                ':payment' => $DadosResultado->paymentUrl,
                ':id' => $_SESSION['id']
            ));

            $stmt = $conn->prepare("UPDATE backup SET referenceId = :referenceid, qrcode = :qrcode, paymentUrl = :payment WHERE `user_id` = :id");
            $stmt->execute(array(
                ':referenceid' => $DadosResultado->referenceId,
                ':qrcode' => $DadosResultado->qrcode->base64,
                ':payment' => $DadosResultado->paymentUrl,
                ':id' => $_SESSION['id']
            ));
           header("Location: statusPicPay.php?id=".$DadosResultado->referenceId);
        }
            

            }else{
                echo '<script>alert("Erro! Tente Novamente!");</script>';
            }
                    }
                    
                ?>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>