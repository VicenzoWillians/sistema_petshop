<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8"/>
        <title> Consulta de Animais por Nome | Pet Shop </title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/form.css"/>
        <link rel="stylesheet" type="text/css" href="css/table.css"/>
        <link rel="shortcut icon" href="images/icon.png">
    </head>
    <body>
        <?php
            include 'inc/logo.inc';
            include 'inc/menu.inc';
            include 'inc/conteudo.inc';

            if(empty($_POST)){
        ?>
            <h3>Consulte um Animal</h3>
            <div class="form">
                <form action="cons_pet_nome.php" method="POST">
                    <p>
                        <label>Informe o nome do animal</label>
                        <input id="search" type="text" name="nome" placeholder="Pesquisar..." />
                    </p>
                    <input type="submit" value="Consultar"/>
                </form>
            </div>
        <?php
            } else{
                $nome=$_POST["nome"];

                include('inc/conexao.inc');

                $consulta = "SELECT * FROM pet WHERE nome_pet='$nome'";
                $query=mysqli_query($con, $consulta);

                if($consulta){
                    if(mysqli_num_rows($query)>0){
                        include('inc/tabela_2.inc');
                        while(($resultado=mysqli_fetch_assoc($query))!=null){
                            echo '<tr>
                            <td>' . $resultado['id_pet'] . '</td>
                            <td>' . $resultado['nome_pet'] . '</td>
                            <td>' . $resultado['idade_pet'] . '</td>';

                            $consulta_dono = "SELECT * FROM dono";
                            $query_dono=mysqli_query($con, $consulta_dono);

                            if($consulta_dono){
                                while(($resultado_dono=mysqli_fetch_assoc($query_dono))!=null){
                                    if($resultado['id_dono']==$resultado_dono['id_dono']){
                                        echo '<td>' . $resultado_dono['nome_dono'] . '</td>
                                        <td>' . $resultado_dono['telefone_dono'] . '</td>';
                                    }
                                }
                            }
                        }
                        include('inc/fim_tabela.inc');
                    } else{
                        echo "<h3>$nome não está cadastrado(a)</h3>";
                    }
                } else{
                    echo "Erro de Sintaxe SQL<br/>";
                    echo mysqli_erro($con);
                }

                mysqli_close($con);
            }

            include 'inc/rodape.inc';
        ?>
    </body>
</html>