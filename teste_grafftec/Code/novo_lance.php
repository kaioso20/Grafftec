
<?php
    include_once "../DBlink/conexao.php";
    
    if(empty($_GET["codigo"])){
        header("Location: index.php");
    }
    $codigo = $_GET["codigo"];

    $validar = "SELECT * FROM produto_tb WHERE valor_final IS NULL AND id_produto=$codigo";
    $validacao = mysqli_query($conexao_fix,$validar);

    $aux_validacao = mysqli_fetch_array($validacao);
    if(!$aux_validacao){
        header("Location: index.php");
    }

    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);

    $aux2 = "SELECT * FROM produto_tb";
    $sel_produto = mysqli_query($conexao_fix,$aux2);

    $aux3 = "SELECT MAX(valor_lance) FROM lance_tb WHERE id_produto=$codigo";
    $sel_maior_lance = mysqli_query($conexao_fix,$aux3);

    while($aux_maiorL = mysqli_fetch_array($sel_maior_lance)){
        $maiorLance = $aux_maiorL["MAX(valor_lance)"];
    }
    $lances = " SELECT * FROM lance_tb l, pessoa_tb pe , produto_tb pr WHERE pr.id_produto=l.id_produto AND pe.id_pessoa = l.id_pessoa AND l.id_produto=$codigo ORDER BY valor_lance DESC";

    $sel_lances = mysqli_query($conexao_fix,$lances);


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Sistema de Leilão</title>
    <meta charset="utf-8">
      
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="../Bibliotecas/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
    <script type="text/javascript" src="../Bibliotecas/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
      
  </head>
    <body>
        <main>
            <div class="container" style="margin-top:30px;">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="index.php">
                            <button class="btn btn-primary">
                                Voltar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row"> 
                    <?php
                        //Puxando todos os produtos e verificando o código da URL com a ID
                        while($aux = mysqli_fetch_assoc($sel_produto)){
                            if($codigo == $aux["id_produto"]){
                                $aux_valorInicial = $aux["valor_inicial"];
                    ?>
                        <div class="card mt-4" style="margin-top:50px;margin-buttom:30px;">
                            <div class="card-body">
                                <h3 class="card-title">
                                    <strong>
                                        <?php echo $aux["nm_prod"]; ?>
                                    </strong>
                                </h3>
                                <h4>
                                    Preço Inicial: <?php echo "R$" . $aux_valorInicial; ?>
                                </h4>
                                <h4>
                                    Maior Lance:
                                    <?php
                                        if(empty($maiorLance)){
                                            echo '<div style="color:gray;"><h1>';
                                            echo "Não possui lances ainda, seja o primeiro!";
                                            echo '</h1></div>';
                                        }else{
                                            echo '<div style="color:green;"><h1>(BRL) R$ ';
                                            echo $maiorLance;
                                            echo '</h1></div>';
                                        }
                                    ?>
                                </h4>
                            <p class="card-text">
                                Realize seu lance de forma bem simples, basta apenas adicionar o seu nome e o valor do seu lance!
                            </p>
                            <hr>
                            <div class="row">
                                <form action="index.php" method="POST">
                                    <div class="col-sm-1">
                                        Valor do Lance:
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="00,00" id="moeda" autofocus name="valor_lance" maxlength="12" required/>
                                        <script>
                                            $(document).ready(function(){
                                                $('#moeda').mask('0.000.000,00', {reverse: true});
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-1">
                                        Seu nome:
                                    </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="id_pessoa">
                                        
                                    <?php
                                        echo "<option>-</option>";
                                
                                        //Buscando todos os nomes pra colocar nas opções
                                        while($aux_alt = mysqli_fetch_assoc($sel_pessoa)){
                                            echo "<option value='" . $aux_alt['id_pessoa']."'> " . $aux_alt['nm_pessoa'] . "</option>";   
                                        }
                                    ?>
                                        
                                    </select>
                                </div>
                                <input type="hidden" name="id_produto" value="<?php echo $codigo?>"/>
                                <input type="hidden" name="maiorLance" value="<?php echo $maiorLance;?>" />
                                <input type="hidden" name="valor_inicial" value="<?php echo $aux_valorInicial;?>" />
                                <input type="submit" value="Enviar Lance" name="btn-cad-lance" class="btn btn-primary"/>
                                </form>
                            </div>
                            </div>
                        </div>
                    <?php 
                            }
                        }
                    ?>
                </div>
                <hr>
                    <?php
                
                        //Verifica se possui alguma oferta para o produto, só assim ele libera o botão
                        if(empty(!$maiorLance)){
                    ?>
                        <div class="row">
                            <form action="index.php" method="POST">
                                <input type="hidden" name="maiorLance" value="<?php echo $maiorLance;?>"/>
                                <input type="hidden" name="codigo" value="<?php echo $codigo;?>"/>
                                <input type="submit" name="Def_vencedor" value="Definir vencedor e finalizar lances" class="btn btn-primary" />
                            </form>
                        </div>
                        <hr>
                        <div class="row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"> ID </th>
                                        <th scope="col"> Nome </th>
                                        <th scope="col"> Lance </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while($aux_lances = mysqli_fetch_assoc($sel_lances)){              
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $aux_lances["id_lance"];?>
                                            </th>
                                            <td>
                                                <?php echo $aux_lances["nm_pessoa"];?>
                                            </td>
                                            <td>
                                                <?php echo $aux_lances["valor_lance"];?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                        }
                    ?>
                
            </div>
        </main>
    </body>
</html>