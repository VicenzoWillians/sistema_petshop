<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8"/>
        <title> Editar Informações | Pet Shop </title>
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

                $id_pet=$_GET['id_pet'];
                $id_dono=$_GET['id_dono'];

                include('inc/conexao.inc');

                $resultado_pet = "SELECT * FROM pet WHERE id_pet=$id_pet";
                $resultado_dono = "SELECT * FROM dono WHERE id_dono=$id_dono";

                $query_pet=mysqli_query($con, $resultado_pet);
                $query_dono=mysqli_query($con, $resultado_dono);

                $pet=mysqli_fetch_assoc($query_pet);
                $dono=mysqli_fetch_assoc($query_dono);

                echo '<h3> Edite as informações </h3>';
                echo '<div class="form">
                    <form action="editar_info.php" method="POST">
                        <input type="hidden" name="id_pet" value="' . $pet['id_pet'] .'"/>
                        <input type="hidden" name="id_dono" value="' . $dono['id_dono'] . '"/>
                        <p>
                            <label>Nome do Animal</label>
                            <input type="text" name="nome_pet"  value="' . $pet['nome_pet'] . '" required/>
                        </p>
                        <p>
                            <label>Idade do Animal</label>
                            <input type="number" name="idade_pet"  value="' . $pet['idade_pet'] . '" required/>
                        </p>
                        <p>
                            <label>Nome do Dono</label>
                            <input type="text" name="nome_dono"  value="' . $dono['nome_dono'] . '" readonly/>
                        </p>
                        <p>
                            <label>Telefone</label>
                            <input type="text" name="telefone_dono" value="' . $dono['telefone_dono'] . '" required/>
                        </p>
                        <p>
                            <input type="submit" value="Editar"/>
                        </p>
                    </form>
                </div>';

                mysqli_close($con);

            } else {
                $id_pet=$_POST["id_pet"];
                $id_dono=$_POST["id_dono"];
                $nome_pet=$_POST["nome_pet"];
                $idade_pet=$_POST["idade_pet"];
                $telefone=$_POST["telefone_dono"];

                include('inc/conexao.inc');

                $resultado_pet = "UPDATE pet SET nome_pet='$nome_pet', idade_pet='$idade_pet'
                WHERE id_pet='$id_pet' ";
                $query_pet=mysqli_query($con, $resultado_pet);

                if(mysqli_affected_rows($con)){
                    $affected=1;
                }

                $resultado_dono = "UPDATE dono SET telefone_dono='$telefone'
                WHERE id_dono='$id_dono' ";
                $query_dono=mysqli_query($con, $resultado_dono);

                if(mysqli_affected_rows($con)){
                    $affected=1;
                } else{
                    $affected=0;
                }

                if($affected==1){
                    echo "<h3> Informações Editadas com Sucesso!</h3>";
                } else{
                    echo "<h3> Informações não Foram Editadas. Não Houve Alterações!</h3>";
                }

                mysqli_close($con);
            }

            include 'inc/rodape.inc';
        ?>
    </body>
</html>