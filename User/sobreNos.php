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
    <section id="sobreNos">
        <div class="containerAboutUs">
            <h1>Sobre nós</h1>
            <div class="rowAboutUs">
                <img src="./assets/images/imageAboutUs.svg">
                <div class="legendaAboutUs">
                    <div class="h1legendaAboutUs">
                        <h2>Sobre a <h1>WayneEnterprise</h1></h2>
                    </div>
                    <p><?php echo $sobreEmpresa; ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php
        include_once("estrutura/footer.php")
    ?>
</body>
</html>