<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro alunos</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
<body>

<?php

include "conexao.php";

if(isset($_GET["Matricula"])){$Matricula=$_GET["Matricula"];}
if(isset($_GET["Nome"])){$Nome=$_GET["Nome"];}
if(isset($_GET["Celular"])){$Celular=$_GET["Celular"];}
if(isset($_GET["Botao"])){$Botao=$_GET["Botao"];}

// ============== Cadastro de Alunos ========================================================
if ($Botao == "Incluir")
{
   try 
   {
        $Comando=$conexao->prepare("insert into Alunos (Matricula,Nome,Celular) values (?, ?, ?)");
        $Comando->bindParam(1, $Matricula);
        $Comando->bindParam(2, $Nome);
        $Comando->bindParam(3, $Celular);
         
        $Comando->execute();

        if ($Comando->rowCount() > 0) 
        {
            $Matricula = null;
            $Nome = null;
            $Celular = null;

            echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
         } 
         else 
         {
            echo "Erro ao tentar efetivar a inclusão";
         }
        
    } 
    catch (PDOException $erro) 
    {
        echo "Erro: " . $erro->getMessage();
    } 
}


// ============== Exclusao de Alunos ======================================================
if ($Botao == "Excluir")
{
    try 
    {
        $Comando = $conexao->prepare("delete from Alunos where Matricula = ?");
        $Comando->bindParam(1, $Matricula);

        $Comando->execute();
 
	if ($Comando->rowCount() > 0)
        {
            $Matricula = null;

            echo "<script>alert('Exclusao efetuado com sucesso!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        } 
        else 
        {
            echo "Erro ao tentar efetivar a exclusão";
        }
    } 
    catch (PDOException $erro) 
    {
        echo "Erro: ".$erro->getMessage();
    }
}


// ============== Alteracao de Alunos ======================================================
if ($Botao == "Alterar")
{
	try 
 	{
        $Comando = $conexao->prepare("update Alunos set Nome=?, Celular=? where Matricula=?");
        $Comando->bindParam(1, $Nome);
        $Comando->bindParam(2, $Celular);
        $Comando->bindParam(3, $Matricula);

	$Comando->execute();

        if ($Comando->rowCount() > 0) 
        {
            $Matricula = null;
            $Nome = null;
            $Celular = null;

            echo "<script>alert('Alteração efetuado com sucesso!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        } 
        else 
        {
            echo "Erro ao tentar efetivar a alteração";
        }
    } 
    catch (PDOException $erro) 
    {
        echo "Erro: ".$erro->getMessage();
    }
}


// ============== Consulta de Alunos ======================================================
if ($Botao == "Consultar")
{
    // consulta por bloco ---------------------------------------------
    try 
    {
        if ($Matricula == '')
        {
            $Matriz = $conexao->prepare("select * from Alunos");
        }
        else
        {
            $Matriz = $conexao->prepare("select * from Alunos where Matricula = ?");
            $Matriz->bindParam(1, $Matricula);
        }
        
 
        if ($Matriz->execute()) 
        {
            while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
            {
                echo 'Matricula ' . $Linha->Matricula . '<br>';
                echo 'Nome      ' . $Linha->Nome 	  . '<br>';
                echo 'Celular   ' . $Linha->Celular   . '<br>';
                echo '<br>';
            }
        } 
        else 
        {
            echo "<script>alert('Não foi possivel completar a consulta!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        }
    } 
    catch (PDOException $erro) 
    {
        echo "Erro: ".$erro->getMessage();
    }


    // consulta por tabela ---------------------------------------------
    try 
    {
         if ($Matricula == '')
        {
            $Matriz = $conexao->prepare("select * from Alunos");
        }
        else
        {
            $Matriz = $conexao->prepare("select * from Alunos where Matricula = ?");
            $Matriz->bindParam(1, $Matricula);
        }
 
        if ($Matriz->execute()) 
        {
            echo '<table border=1>';
            echo '<th> Matricula </th>';
            echo '<th> Nome </th>';
            echo '<th> Celular </th>';
            echo '<th> Alterar </th>';
            echo '<th> Excluir </th>';

            while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
            {
                echo '<tr>';
                    echo '<td>' . $Linha->Matricula . '</td>';
                    echo '<td>' . $Linha->Nome      . '</td>';
                    echo '<td>' . $Linha->Celular   . '</td>';
					echo '<td> <a href=CadAlunos.php?Matricula=' . $Linha->Matricula . '&Botao=Consultar> <img src="Alterar.png" width="25%"> </a></td>';
					echo '<td> <a href=CadAlunos.php?Matricula=' . $Linha->Matricula . '&Botao=Excluir> <img src="Excluir.png" width="25%"> </a></td>';

                echo '</tr>';
            }
            echo '</table>';
        } 
        else 
        {
            echo "<script>alert('Não foi possivel completar a consulta!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        }
    } 
	catch (PDOException $erro) 
    {
        echo "Erro: ".$erro->getMessage();
    }


    // consulta por formulario ---------------------------------------------
    if ($Matricula == '')
    {
        echo '<br><br>' . 'Favor preencher Matricula para Busca em formulario';
        //echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        exit;
    }

    try 
    {
        $Matriz = $conexao->prepare("select * from Alunos where Matricula = ?");
        $Matriz->bindParam(1, $Matricula);

        if ($Matriz->execute()) 
        {
            $Linha = $Matriz->fetch(PDO::FETCH_OBJ);
        
            ?> 
	    <!-- fechei acima o PHP -->
 
            <!-- ===== INICIO DO FORMULARIO EM HTML ===== -->
            <form action="CadAlunos.php" method="get" name="CadAlunos" >
                <h1>Cadastro de Alunos</h1>
                <hr>

                <label>Matricula:</label>
                <input type="text" name="Matricula" value="<?php echo $Linha->Matricula ?>" /><br>
          
                <label>Nome:</label>
                <input type="text" name="Nome" value="<?php echo $Linha->Nome ?>" /><br>
          
                <label>Celular:</label>
                <input type="text" name="Celular" value="<?php echo $Linha->Celular ?>" /><br><br>

                <input type="submit" name="Botao" value="Incluir" />
                <input type="submit" name="Botao" value="Excluir" />
                <input type="submit" name="Botao" value="Alterar" />
                <input type="submit" name="Botao" value="Consultar" />

                <input type="reset" name="Botao" value="Limpar" />

                <hr>
            </form>
            <!-- ===== FIM DO FORMULARIO EM HTML ===== -->

	    <!-- abri abaixo o PHP -->
            <?php
        } 
        else 
        {
            echo "<script>alert('Não foi possivel completar a consulta!')</script>";
            echo('<meta http-equiv="refresh"content=0;"CadAlunos.html">');
        }
    } 
    catch (PDOException $erro) 
    {
        echo "Erro: ".$erro->getMessage();
    }
}

?>

</body>
</html>