<?php
    include_once "../DBlink/conexao.php";

    /*
    Realiza o cadastro de um novo lance (tabela lance_tb), porém, ele também verifica se os valores são menores ou
    iguais tanto para o valor inicial quanto para o valor do maior lance, caso seja maior o valor, ele cadastra
    no banco de dados
    */
    if(isset($_POST["btn-cad-lance"])){
        $id_pessoa = $_POST["id_pessoa"];
        $id_produto = $_POST["id_produto"];
        $valor = $_POST["valor_lance"];
        $maiorLance = $_POST["maiorLance"];
        $lanceInicial = $_POST["valor_inicial"];
        
        if($valor <= $maiorLance){
            echo"<script>alert('Não foi possivel efetuar o lance pois ele é menor ou igual ao maior lance, retorne à página de lances e realize uma nova tentativa!');</script>";
        }elseif($valor <= $lanceInicial){
            echo"<script>alert('Não foi possivel efetuar o lance pois ele é menor ou igual ao lance Inicial, retorne à página de lances e realize uma nova tentativa!');</script>";
        }else{
            if(empty($id_pessoa)){
                echo"Sem receber pessoa";
            } else {
                $enviar = "INSERT INTO lance_tb VALUES ('',$id_pessoa,$id_produto,'$valor')";
                $envio = mysqli_query($conexao_fix,$enviar);
                if(!$envio){
                    echo"<script>alert('Precisa cadastrar uma pessoa obrigatoriamente');</script>";
                }      
            }
        }
    }

    // Atualiza os dados do produto quando é definido o fim do leilão de um determinado produto
    if(isset($_POST["Def_vencedor"])){
        $maiorLance = $_POST["maiorLance"];
        $codigo_local = $_POST["codigo"];
        $atualizar = "UPDATE produto_tb SET valor_final='$maiorLance' WHERE id_produto=$codigo_local";
        $envio = mysqli_query($conexao_fix,$atualizar);
    }
    
    //Cadastro de produto
    if(isset($_POST["btn-cad-produto"])){
        $nm_prod = $_POST["nm_produto"];
        $vi = $_POST["valor_inicial"];
        $id_pessoa = $_POST["id_pessoa"];
        
        $envia = "INSERT INTO produto_tb VALUES ('','$nm_prod','$vi',null,'$id_pessoa');";
        $conex = mysqli_query($conexao_fix,$envia);
        if(!$conex){
             echo "<script>alert('Problemas ao cadastrar novo para o banco de dados, realize um novo envio!');</script>";
        }  
    }

    //Seleção de todos os registros da tabela pessoa
    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);

    //Seleção de todos os registros da tabela produto
    $aux2 = "SELECT * FROM produto_tb";
    $sel_produto = mysqli_query($conexao_fix,$aux2);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Sistema de Leilão</title>
    <meta charset="utf-8">
  </head>
  <body>
      <main>
        <div class="container" style="margin-top:20px; text-align:center;">
            <div class="row">
                <div class="btn-group btn-group-justified">
                    <a href="cad_pessoa.php" class="btn btn-primary">Cadastrar Pessoa</a>
                    <a href="list_pessoa.php" class="btn btn-primary">Listar Pessoas</a>
                    <a href="cad_produto.php" class="btn btn-primary">Cadastrar Produto</a>
                  </div>
            </div>
        </div>
        <hr> 
        <div class="container" style="margin-top:90px; float:center;">
            <div class="row">
                <div class="col-sm-3">
                    <h4>
                        <strong>
                            <label class="label-control">
                                Nome
                            </label>
                        </strong>
                    </h4>
                </div>
                <div class="col-sm-2">
                    <h4>
                        <strong>
                            <label class="label-control">
                                Preço Inicial
                            </label>
                        </strong>
                    </h4>
                </div>
                <div class="col-sm-2">
                   <h4>
                        <strong>
                            <label class="label-control">
                                Disponibilidade
                            </label>
                        </strong>
                    </h4>
                </div>
                <div class="col-sm-2" style="text-align:center;">
                    <h4>
                        <strong>
                            <label class="label-control">
                                Maior Lance
                            </label>
                        </strong>
                    </h4>
                </div>
                <div class="col-sm-3" style="text-align:center;">
                    <h4>
                        <strong>
                            <label class="label-control">
                                Lance
                            </label>
                        </strong>
                    </h4>
                </div>
            </div>
            <?php
                
                //Listagem de todos os produtos
                while($aux = mysqli_fetch_assoc($sel_produto)){
                    $codigo = $aux["id_produto"];
            ?>
            <div class="row" style="margin-top:30px;margin-bottom:30px;">
                <div class="col-sm-3">
                    <?php echo $aux['nm_prod'];?>
                </div>
                <div class="col-sm-2">
                 (BRL)R$ <?php echo $aux['valor_inicial'];?>
                </div>
                <?php
                    
                    //Verificação para a liberação do botão de realizar lance, terminando apenas no else da linha 175 para caso venha vazia a registro de valor final
                    if(empty($aux["valor_final"])){
                        $vf= "Disponível!";
                ?>
                <div class="col-sm-2" style="background-color:#eee; border-radius:15px">
                    <?php echo $vf;?>
                </div>
                <div class="col-sm-2" style="background-color:green;color:white; border-radius:15px; text-align:center;">
                    <?php
                        //Realizando uma consulta sql para mostrar o maior lance, e também verifica se não está vindo vazio o array
                        //OBS: ele está aqui pois é preciso o código que apenas foi solicitado na seleção de produtos
                        $aux3 = "SELECT MAX(valor_lance) FROM lance_tb la, produto_tb pr WHERE pr.id_produto = la.id_produto AND pr.id_produto=$codigo";
                        $sel_lance = mysqli_query($conexao_fix,$aux3);
                        
                        while($aux = mysqli_fetch_assoc($sel_lance)){
                            if(empty($aux["MAX(valor_lance)"])){
                                echo "-";
                            }else{
                                echo "(BRL)R$ " .$aux["MAX(valor_lance)"];
                            }
                        }
                    ?>
                    
                    
                </div>
                <div class="col-sm-3" style="text-align:center;">
                    <a href="novo_lance.php?codigo=<?php echo $codigo; ?>">
                        <button class="btn btn-primary">
                            Lance
                        </button>
                    </a>
                </div>
                <?php
                    } else {
                        $vf= $aux["valor_final"];
                ?>
                <div class="col-sm-6" style="text-align:center; background-color:#eaeaea; border-radius:10px;" >
                    <strong>
                        (BRL)R$ <?php echo $vf;?>
                    </strong>
                <br>
                Leilão finalizado
                </div>
                <?php
                    }
                ?>
            </div>
            <hr>
            <?php
                }
            ?>
        </div>
      </main>
  </body>
</html>