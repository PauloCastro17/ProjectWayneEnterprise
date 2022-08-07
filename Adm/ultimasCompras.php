<!DOCTYPE html>
<html lang="en">
<?php
    include_once("./estrutura/head.php");
    session_start();
?>
<body>
<?php
    include_once("./estrutura/header.php");
?>

<section id="ultimasCompras">
    <div class="containerUltimasCompras">
        <h1>Últimas Compras</h1>
        <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        
        ?>
        <div class="rowUltimasCompras">
            <div class="tableUltimasCompras">
                <table>
                    <tr>
                        <th>Nome Usuário</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Forma de Pagamento</th>
                        <th>Situação da compra</th>
                        <th>Total</th>
                    </tr>
                    <?php 
                        $stmt = $conn->prepare("SELECT * FROM usuarios, produtos, carrinho WHERE fk_id_user = id_user AND fk_id_produto = id_produto");
                        $stmt ->execute();
                        foreach ($stmt as $row){
                            echo '<tr>
                                    <td>'.$row['nome_user'].'</td>
                                    <td>'.$row['nome_produto'].'</td>
                                    <td>'.$row['quant_produto'].'</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>'.$row['total'].'</td>
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