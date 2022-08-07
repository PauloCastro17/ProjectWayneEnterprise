<?php

        $ReferenceId = rand(1000, 9999);
    $TokenMercadoPago = 'TEST-6178869949976929-062114-9acfba9b5f6e3b12b7ae95957bd2861a-1060316524';


        session_start();

        $ch = curl_init();

        //URL de local de pagamento
        curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payment_methods');

        //verificar transferência
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //SSL verificação
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //Enviar Headers
        $headers = [];
        $headers[] = 'Authorization: Bearer '.$TokenMercadoPago.'';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //fazer requisição
        $result = curl_exec($ch);

        //fechar
        curl_close($ch);

        $DadosResultado = json_decode($result, true);

       // var_dump($DadosResultado);

        foreach ($DadosResultado as $resultado){
            echo '<h1>'.$resultado['name'].'</h1>';
        }

       
       ?>