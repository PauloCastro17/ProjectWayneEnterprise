<?php
    include_once("../../classes/connection.php");
    session_start();
    $ReferenceId = rand(1000, 9999);
    $TokenMercadoPago = 'TEST-6178869949976929-062114-9acfba9b5f6e3b12b7ae95957bd2861a-1060316524';
    
    $stmt = $conn->prepare("SELECT * FROM carrinho, produtos WHERE fk_id_user = :id");
    $stmt->execute(array(
        ':id'	=> $_SESSION['id']
    ));
    foreach ($stmt as $row){
        $nomeProduto = $row['nome_produto'];
        $quantity = $row['quant_produto'];
        $total = $row['total'];
        $imagem = $row['imagem_produto'];
    }
    $dadosCompra = [
        "additional_info"=> [
            "items"=> [
              [
                "id"=> $ReferenceId,
                "title"=> $nomeProduto,
                "description"=> "Product Wayne Enterprise",
                "picture_url"=> $imagem,
                "category_id"=> "roupa",
                "quantity"=> $quantity,
                "unit_price"=> $total
              ]
            ],
            "payer"=> [
              "first_name"=> "Test",
              "last_name"=> "Test",
              "phone"=> [
                "area_code"=> 11,
                "number"=> "987654321"
              ],
              "address"=> []
            ],
            "shipments"=> [
              "receiver_address"=> [
                "zip_code"=> "12312-123",
                "state_name"=> "Rio de Janeiro",
                "city_name"=> "Buzios",
                "street_name"=> "Av das Nacoes Unidas",
                "street_number"=> 3003
              ]
            ],
            "barcode"=> []
          ],
          "description"=> "Payment for product",
          "external_reference"=> "MP0001",
          "installments"=> 1,
          "metadata"=> [],
          "payer"=> [
            "entity_type"=> "individual",
            "type"=> "customer",
            "identification"=> []
          ],
          "payment_method_id"=> "visa",
          "transaction_amount"=> $total
        ];

        $ch = curl_init();

        //URL de local de pagamento
        curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments');

        //verificar transferência
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //SSL verificação
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //dados comnpra
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosCompra));

        //Enviar Headers
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$TokenMercadoPago.'';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //fazer requisição
        $result = curl_exec($ch);

        //fechar
        curl_close($ch);

        $DadosResultado = json_decode($result, true);

        var_dump($DadosResultado);



       
       ?>