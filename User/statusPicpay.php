<?php
            include_once("./classes/connection.php");
            $reference_id = $_GET['id'];
            if(!empty($reference_id)){
                $TokenPicPay = 'e78c10be-8367-40c7-aaa4-60c9b70f655c';
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
                                            
                //var_dump($DadosResultado);

                $stmt = $conn->prepare("UPDATE `pagamento` SET `status` = :status, cod_status = :cod_status WHERE id_pagamento = :id");
                $stmt->execute(array(
                    ':status' => $DadosResultado->status,
                    ':cod_status' => $cod_status,
                    ':id' => $reference_id
                ));
                header("Location: mostraQrCode.php");

                
            }else{
                echo '<script>alert("ERRO!")</script>';
            }
        
        ?>