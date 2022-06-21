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
        include_once("estrutura/header.php")
    ?>
    <section id="contateNos">
        <div class="containerContactUs">
            <h1>Contate-nos</h1>
            <div class="rowContactUs">
                <img src="./assets/images/imageContactUs.svg">
                <div class="infosContactUs">
                    <div class="info1">
                        <p>Tel: <?php echo $telEmpresa; ?></p>
                        <p><?php echo $emailEmpresa; ?></p>
                    </div>
                    <div class="info2">
                        <p><?php echo $endereco1; ?></p>
                        <p><?php echo $endereco2; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>