<?php

    //Realizando o vínculo com a base de dados

    $local = "localhost";
    $user="root";
    $senha="";
    $banco="leilao_db";

    $conexao_fix = mysqli_connect($local,$user,$senha,$banco);
    if(!$conexao_fix){
        die("Deu BO no banco");
    }
?>