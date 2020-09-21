<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8"/>
        <title> Cadastrar Pessoa | Pet Shop </title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/form.css"/>
        <link rel="shortcut icon" href="images/icon.png">
    </head>
    <body>
        <?php
            include 'inc/logo.inc';
            include 'inc/menu.inc';
            include 'inc/conteudo.inc';
           
            if(empty($_POST)){
        ?>
            <h3> Cadastre uma pessoa </h3>
            <div class="form">
                <form action="cad_pessoa" method="POST">
                    <p>
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Vicenzo Willians" required/>
                    </p>
                    <p>
                        <label>Telefone</label>
                        <input type="text" name="telefone" placeholder="(16) 9123-4567" required/>
                    </p>
                    <p>
                        <input type="submit" value="Cadastrar"/>
                    </p>
                </form>
            </div>

        <?php
            } else {
                $nome=$_POST["nome"];
                $telefone=$_POST["telefone"];

                include('inc/conexao.inc');

                $SQL = "INSERT INTO dono (nome_dono, telefone_dono)
                    VALUES ('$nome', '$telefone')";
                
                $query=mysqli_query($con, $SQL);

                if($query){
                    echo "<h3>$nome Cadastrado(a) com Sucesso</h3>";
                } else{
                    echo mysqli_error($con);
                }

                mysqli_close($con);
            }

            include 'inc/rodape.inc';
        ?>
    </body>
</html>