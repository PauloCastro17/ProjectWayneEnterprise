<?php
include_once("./classes/connection.php");
session_start();

$reference_id = $_GET['id'];
$TokenPicPay = '';
$ch = curl_init();

//URL de local de pagamento
curl_setopt($ch, CURLOPT_URL, 'https://appws.picpay.com/ecommerce/public/payments/'.$reference_id.'/status');

//verificar transferência
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//SSL verificação
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

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
$cod_status = $DadosResultado->status;

if($cod_status == "created"){
    $cod_status = 1;
}
if($cod_status == "expired"){
    $cod_status = 2;
}
if($cod_status == "analysis"){
    $cod_status = 3;
}
if($cod_status == "paid"){
    $cod_status = 4;
}
if($cod_status == "completed"){
    $cod_status = 5;
}
if($cod_status == "refunded"){
    $cod_status = 6;
}
if($cod_status == "chargeback"){
    $cod_status = 7;
}
            if(!empty($reference_id)){
                $reference_id = $_GET['id'];
                $ch = curl_init();

                //URL de local de pagamento
                curl_setopt($ch, CURLOPT_URL, 'https://appws.picpay.com/ecommerce/public/payments/'.$reference_id.'/cancellations');

                //verificar transferência
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                //SSL verificação
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

                //Requisição pelo método POST
                curl_setopt($ch, CURLOPT_POST, true);

                if(isset($DadosResultado->authorizationId)){
                    //Enviar Dados para o cancelamento 
                    $data_authorization = ['authorizationId' => $DadosResultado->authorizationId];
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_authorization));
                }
                    //Enviar Headers
                    $headers = [];
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'x-picpay-token:'.$TokenPicPay;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    //fazer requisição
                    $result = curl_exec($ch);

                    //fechar
                    curl_close($ch);

                    $stmt = $conn->prepare("DELETE FROM `pagamento` WHERE id_pagamento = :id");
                    $stmt->execute(array(
                        ':id' => $reference_id
                    ));
                    header("Location: shoppingCart.php");
                
            }else{
                echo '<script>alert("ERRO!")</script>';
            }
        
        ?>