<?php
    include_once "DBlink/conexao.php";
    if(!$conexao_fix){
        die("O banco de dados não foi vinculado corretamente, não possui nenhum dado selecionado!");
    }else{
        header("Location: Code/index.php");
    }
?>