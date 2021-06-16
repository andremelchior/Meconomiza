<?php

include "conexao.php";

session_start();
session_destroy(); 

if(isset($_GET["Nome"])){$Nome=$_GET["Nome"];}
if(isset($_GET["Email"])){$Email=$_GET["Email"];}
if(isset($_GET["Senha"])){$Senha=$_GET["Senha"];}

    try 
    {
        $Comando=$conexao->prepare("insert into cliente (Nome) values (?)");
        
        $Comando->bindParam(1, $Nome);
        $Comando->execute();

        

        if ($Comando->rowCount() > 0)
        {
            $Nome = null;

        }
        else
        {
            $ReturnJSON = "Erro ao efetuar o cadastro, tente novamente!";
        }

        $Comando=$conexao->prepare("insert into contato (Email) values (?)");
        $Comando->bindParam(1, $Email);

        $Comando->execute();

        if ($Comando->rowCount() > 0)
        {
            $Email = null;

            $Comando = $conexao->prepare("select Cod_Cliente, Cod_Contato from Cliente order by Cod_Cliente desc limit 1");
            
            $Comando->execute();
            $Client = $Comando->fetchAll();


            $Comando = $conexao->prepare("update contato set Cod_Cliente = ? where Cod_Contato = 1");
            $Comando->bindParam(1, $Client);
            $Comando->execute();


            $ReturnJSON = "Cadastro efetuado com sucesso!";
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