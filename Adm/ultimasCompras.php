<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    session_start();

    $stmt = $conn->prepare("SELECT * FROM carrinho, usuarios ");
    $stmt->execute();
    foreach ($stmt as $row){
        if($row['fk_id_user'] == $row['id_user']){
            $stmt2 = $conn->prepare('SELECT SUM(total) FROM carrinho WHERE fk_id_user = fk_id_user');
            $stmt2->execute();

            foreach ($stmt2 as $row){
                $total = $row[0];
            }
    }
}

?>
<body>
<?php
    include_once("./estrutura/header.php");
?>

<section id="ultimasCompras">
    <div class="containerUltimasCompras">
        <h1>Últimas Compras</h1>
        <div class="rowUltimasCompras">
            <div class="tableUltimasCompras">
                <table>
                    <tr>
                        <th>Nome Usuário</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Forma de Pagamento</th>
                        <th>Situação da compra</th>
                        <th>Data Criada</th>
                        <th>Data Vencimento</th>
                    </tr>
                    <?php 
                        $stmt = $conn->prepare("SELECT * FROM usuarios, produtos, carrinho, backup WHERE fk_id_user = id_user AND fk_id_produto = id_produto AND user_id = fk_id_user");
                        $stmt ->execute();
                        foreach ($stmt as $row){
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

                            echo '<tr>
                                    <td>'.$row['nome_user'].'</td>
                                    <td>'.$row['nome_produto'].'</td>
                                    <td>'.$row['quant_produto'].'</td>
                                    <td>PicPay</td>
                                    <td>'.$cod_status.'</td>
                                    <td>'.$brasil2.'</td>
                                    <td>'.$brasil.'</td>
                                    </tr>';
                        } 
                        ?>
                </table>
            </div>
        </div>
    </div>
</section>

<?php 
    include_once("./estrutura/footer.php")
?>
</body>
</html>