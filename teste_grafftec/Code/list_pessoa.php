<?php
    include_once "../DBlink/conexao.php";

    //Cadastro/Alteração de Pessoa
    if(isset($_POST["btn-cad-pessoa"])){
        $id = $_POST["id"];
        $nm_pessoa = $_POST["nm_pessoa"];
        $idade = $_POST["idade"];
        
        //Caso o valor imposto venha com parametro, ele altera, senão ele cria um novo
        if(empty($id)){
            $envia = "INSERT INTO pessoa_tb VALUES ('','$nm_pessoa',$idade)";
        } else {
            $envia = "UPDATE pessoa_tb 
                        SET nm_pessoa = '$nm_pessoa',
                            idade = '$idade'
                        WHERE id_pessoa = '$id';";
        }
        $conex = mysqli_query($conexao_fix,$envia);
        if(!$conex){
            die("Problemas ao cadastrar Pessoa, erro na Database");
        } else {
            if(empty($id)){
               echo "<script>alert('Dados Cadastrados com sucesso!!');</script>"; 
            } else {
                echo "<script>alert('Dados Atualizados com sucesso!!');</script>";
            }   
        }
    }
    
    //Exclusão de pessoa
    if(isset($_POST["btn-excluir-pessoa"])){
        $id = $_POST["id"];
        
        $exclui = "DELETE FROM pessoa_tb WHERE id_pessoa = '$id'";
        $conex = mysqli_query($conexao_fix,$exclui);
        if(!$conex){
            die("Deu BO aqui");
        } else {
           echo "<script>alert('exclusão realizada!!');</script>";
        }
    }

    //Buscando todos os valores de Pessoa
    $aux1 = "SELECT * FROM pessoa_tb";
    $sel_pessoa = mysqli_query($conexao_fix,$aux1);

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
            <div class="container" style="margin-top:40px;">
                <a href="index.php" class="btn btn-primary">
                    Voltar
                </a>
                <a href="cad_pessoa.php" class="btn btn-primary">
                    Nova Pessoa
                </a>
                </div>
                <div class="container" style="margin-top:80px;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><strong>ID</strong></th>
                            <th scope="col"><strong>Nome</strong></th>
                            <th scope="col"><strong>Idade</strong></th>
                            <th scope="col"><strong>Editar</strong></th>
                            <th scope="col"><strong>Excluir</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($aux = mysqli_fetch_array($sel_pessoa)){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $aux['id_pessoa']; ?></th>
                                <td><?php echo $aux['nm_pessoa']; ?></td>
                                <td><?php echo $aux['idade']; ?></td>
                                <td><a href="cad_pessoa.php?codigo=<?php echo $aux['id_pessoa']; ?>">editar</a></td>
                                <td><a href="conf_excluir.php?codigo=<?php echo $aux['id_pessoa']; ?>"> excluir </a> </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>