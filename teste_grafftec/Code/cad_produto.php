<?php
    include_once "../DBlink/conexao.php";

    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
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
        <div class="container" style="margin-top:40px;">
            <a href="index.php">
                <button class="btn">Voltar</button>
            </a>
        </div>
        <main>
          <div class="container" style="margin-top:50px;">
              <form action="index.php" method="POST">
                  
                  <!-- Apenas verifica se possui id, caso possua, ele envia para atualização, caso vá vazio, ele cria uma nova id na base de dados-->
                  <input type="hidden" name="id" value="<?php echo @$id_prod?>">
                  
                  <div class="row">
                    <div class="col-sm-1" style="text-align:right;">
                        Produto:
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="nm_produto" maxlength="60" required />
                    </div>
                  </div>
                  <div class="row" style="margin-top:30px;">
                    <div class="col-sm-2" style="text-align:center;">
                        Valor Inicial (BRL)R$:
                    </div>
                    <div class="col-sm-2">
                        <input class="form-control" id="moeda" size="2" maxlength="12" type="text" name="valor_inicial" placeholder="Ex: 24,00" required/>
                        <script>
                            $(document).ready(function(){
                                $('#moeda').mask('0.000.000,00', {reverse: true});
                            });
                        </script>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="col-sm-1" style="text-align:right;">
                        Dono do produto:
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="id_pessoa" required>
                          <option>-- Escolha uma opção --</option>
                          <?php
                            while($aux = mysqli_fetch_array($sel_pessoa)){
                                echo "<option value='". $aux["id_pessoa"] ."'>" . $aux["nm_pessoa"] . "</option>";
                            }
                          ?>
                        </select>
                    </div>
                </div>
                  <div class="row" style="margin-top:30px;">
                      <div class="col-sm-4">
                        <input type="submit" name="btn-cad-produto" class="btn btn-primary" />
                      </div>
                  </div>
              </form> 
            </div>
        </main>
    </body>
</html>