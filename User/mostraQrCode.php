<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    include_once("./classes/connection.php");
    session_start();
?>
<body>
<?php
    include_once("./estrutura/header.php")
?>

<section id="home">
    <div class="containerHome">
        <h1>QrCode de pagamento</h1>
        <div class="rowHome">
            <div class="mostraQrCode">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM pagamento WHERE user_id = :id");
                    $stmt->execute(array(
                        ':id'	=> $_SESSION['id']
                    ));
                    $resultado = $stmt->fetchAll();
                    foreach ($resultado as $row){
                        $americano = new DateTime($row['data_vencimento']);
                        $brasil = $americano->format('d/m/Y');

                        $americano2 = new DateTime($row['data']);
                        $brasil2 = $americano2->format('d/m/Y');

                        $cod_status = $row['status'];

                        if($cod_status == "created"){
                            $cod_status = "Criado";
                        }
                        if($cod_status == "expired"){
                            $cod_status = "Expirado";
                        }
                        if($cod_status == "analysis"){
                            $cod_status = "Análise";
                        }
                        if($cod_status == "paid"){
                            $cod_status = "Pago";
                        }
                        if($cod_status == "completed"){
                            $cod_status = "Completo";
                        }
                        if($cod_status == "refunded"){
                            $cod_status = "Ressarcido";
                        }
                        if($cod_status == "chargeback"){
                            $cod_status = "Chargeback";
                        }

                        echo '
                                <img src='.$row['qrcode'].'>
                                <div class="qrCodeLegenda">
                                    <p>Situação do pagamento: <span>'.$cod_status.'</span></p>
                                    <p>Data de criação do pagamento: <span>'.$brasil2.'</span></p>
                                    <p>Data limite para pagamento: <span>'.$brasil.'</span></p>
                                </div>
                                <div class="divBtns">
                                    <a href="./statusPicpay.php?id='.$row['referenceId'].'"><button class="btnAtualizar">Atualizar status</button></a>
                                    <a href="./cancelaPicpay.php?id='.$row['referenceId'].'"><button class="btnCancelar">Pedir Cancelamento da Compra</button></a>
                                </div>';
                    }
                ?>
                </div>
        </div>
    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>