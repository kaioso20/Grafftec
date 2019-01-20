<?php
    //inclusão com o banco de dados
    include_once "../DBlink/conexao.php";

    //Comando SQL para solicitar todas as tuplas da tabela pessoa_tb
    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);

    //Pegando os dados via GET do código (id do pessoa) e caso possua a id definida, é feita a alocação dos dados em variáveis que preencheram os campos do cadastro
    if(isset($_GET["codigo"])){
        $id_prod = $_GET["codigo"];
        while($aux = mysqli_fetch_array($sel_pessoa)){
            if($aux['id_pessoa'] == $id_prod){
                $nome = $aux['nm_pessoa'];
                $idade = $aux['idade'];
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>
            Sistema de Leilão
        </title>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container" style="margin-top:40px;">
            <a href="index.php">
                <button class="btn">Voltar</button>
            </a>
        </div>
        <main>
          <div class="container" style="margin-top:50px;">
              <form action="list_pessoa.php" method="POST">
                  
                  <!-- Esta id está sendo enviada novamente CASO ela tenha algum valor, pois se não view com id, ela vai nula e quem cadastra uma nova id é o banco -->
                  <input type="hidden" name="id" value="<?php echo @$id_prod?>">
                  
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="label-control" style="float:right;">
                                Nome:
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" value="<?php echo @$nome; ?>" type="text" name="nm_pessoa" maxlength="30" required />
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px;">
                        <div class="col-sm-1">
                            <div class="label-control" style="float:right;">
                                Idade:
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <input class="form-control" value="<?php echo @$idade; ?>" maxlength="3" type="text" name="idade" required placeholder="Ex: 19" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px;">
                        <div class="col-sm-1">
                            <input type="submit" name="btn-cad-pessoa" class="btn btn-primary" />
                        </div>
                    </div>
              </form> 
            </div>
        </main>
    </body>
</html>