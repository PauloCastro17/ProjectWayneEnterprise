<?php
    session_start();
    if(!$_SESSION['id']){
        header('Location: index.php');
    }else{
        unset(
            $_SESSION['id'],
            $_SESSION['online']
        );

        header('Location: index.php');
    }


?>