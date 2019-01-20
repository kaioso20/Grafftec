<?php

    //Conexão com a página de conexão
    include_once "../DBlink/conexao.php";

    // Comando Sql: Puxar todas pessoas
    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);

    $id = $_GET["codigo"];

    //Caso o valor venha vazio, redireciona para a de listagem
    if(empty($_GET["codigo"])){
        header("Location: list_pessoa.php");
    }
    
    //Listando todas as pessoas, mas também faz a escolha pela id do usuário que queremos excluir
    while($aux = mysqli_fetch_assoc($sel_pessoa)){
        if($aux["id_pessoa"] == $id){
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>
            Sistema de Leilão
        </title>
        <meta charset="utf-8">
    </head>
    <body>
        <main>
            <div class="container" style="margin-top:50px;">
                <div class="row" style="text-align:center;">
                    Deseja excluir o(a) 
                </div>
                <div class="row" style="text-align:center; margin-top:20px;">
                    <label><?php echo $aux["nm_pessoa"] ?></label>
                </div>
                <div class="row" style="text-align:center; margin-top:20px;">
                    <div class="col-sm">
                        <form action="list_pessoa.php" method="POST">
                             <input type="submit" name="btn-excluir-pessoa" class="btn btn-primary" value="SIM" />
                            <input type="hidden" value="<?php echo $id;?>" name="id" />
                        </form>
                    </div>
                    <div class="col-sm">
                        <a href="list_pessoa.php">
                            <input type="button" class="btn" value="NÃO" />
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
<?php
        }
    }
?>