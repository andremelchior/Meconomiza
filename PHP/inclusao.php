<?php

include "conexao.php";

session_start();
session_destroy(); 

if(isset($_GET["Nome"])){$Nome=$_GET["Nome"];}
if(isset($_GET["Email"])){$Email=$_GET["Email"];}
if(isset($_GET["Senha"])){$Senha=$_GET["Senha"];}

    try 
    {
        // === CADASTRO CLIENTE ==============================================
        $Comando=$conexao->prepare("insert into cliente (Nome) values (?)");
        
        $Comando->bindParam(1, $Nome);
        $Comando->execute();

        if ($Comando->rowCount() > 0)
        {
           
            $Comando = $conexao->prepare("select Cod_Cliente from Cliente order by Cod_Cliente desc limit 1");
            
            if($Comando->execute())
            {
                while($Linha = $Comando->fetch(PDO::FETCH_OBJ)) 
                {
                    $Client = $Linha->Cod_Cliente;
                }
            }

        }
        else
        {
            $ReturnJSON = "Erro ao efetuar o cadastro, tente novamente!";
        }

        // === CADASTRO CONTATO ==============================================
        $Comando=$conexao->prepare("insert into contato (Email, Cod_Cliente) values (?, ?)");
        $Comando->bindParam(1, $Email);
        $Comando->bindParam(2, $Client);

        $Comando->execute();

        if ($Comando->rowCount() > 0)
        {
             $ReturnJSON = "Cadastrado com sucesso!";
        }
        else
        {
            $ReturnJSON = "Erro ao efetuar o cadastro, tente novamente!";
        }
    } 
    catch (PDOException $erro) {
        $ReturnJSON = "Erro de conexão: " . $erro->getMessage();
    }

    echo $ReturnJSON;

?>