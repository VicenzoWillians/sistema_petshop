<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8"/>
        <title> Cadastrar Animal | Pet Shop </title>
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
            <h3> Cadastre um Animal </h3>
            <div class="form">
                <?php
                    include('inc/conexao.inc');

                    $dono = "SELECT id_dono, nome_dono FROM dono";
                    $query=mysqli_query($con, $dono);

                    if($dono){
                        if(mysqli_num_rows($query)>0){
                            echo '<form action="cad_pet" method="POST">
                                <p>
                                    <label>Nome</label>
                                    <input type="text" name="nome" placeholder="Rex" required/>
                                </p>
                                <p>
                                    <label>Idade</label>
                                    <input type="number" name="idade" placeholder="5" required/>
                                </p>
                                <p>
                                    <label>Dono</label>
                                    <select name="dono">';

                            while(($resultado=mysqli_fetch_assoc($query))!=null){
                                echo '<option value="' . $resultado['id_dono'] . '">' . $resultado['nome_dono'] . '</option>';
                            }
                            echo '</select>
                            </p>
                            <p>
                                <input type="submit" value="Cadastrar"/>
                            </p>';
                        } else{
                            echo "<h3>Não há pessoas cadastradas para cadastrar um animal</h3>";
                        }
                    } else{
                        echo "Erro de Sintaxe SQL<br/>";
                        echo mysqli_error($con);
                    }
                ?>
            </div>

        <?php
            } else {
                $nome=$_POST["nome"];
                $idade=$_POST["idade"];
                $dono=$_POST["dono"];

                include('inc/conexao.inc');
                
                $select = "SELECT qnt_pet FROM dono WHERE id_dono=$dono";
                $query_select=mysqli_query($con, $select);

                if($select){
                    $resultado=mysqli_fetch_assoc($query_select);

                    if($resultado['qnt_pet']==null){
                        $qnt_pet=1;

                        // INSERINDO QUANTIDADE DE PET DO DONO
                        $insert_qnt_pet = "UPDATE dono SET qnt_pet='$qnt_pet'
                            WHERE id_dono=$dono";
                        $query_qnt_pet=mysqli_query($con, $insert_qnt_pet);

                        if(!$query_qnt_pet){
                            echo mysqli_error($con);
                        }

                        //INSERINDO ANIMAL NA TABELA PET
                        $insert_pet = "INSERT INTO pet (nome_pet, idade_pet, id_dono)
                            VALUES ('$nome', '$idade', '$dono')";
                        $query_pet=mysqli_query($con, $insert_pet);
    
                        if($query_pet){
                            echo "<h3>$nome Cadastrado(a) com Sucesso</h3>";
                        } else{
                            echo mysqli_error($con);
                        }
                    } else{
                        echo "<h3> Não foi possível cadastrar. Dono já possui animal cadastrado!</h3>";
                    }
                }

                mysqli_close($con);
            }

            include 'inc/rodape.inc';
        ?>
    </body>
</html>