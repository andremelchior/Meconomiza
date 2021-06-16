<?php

include "conexao.php";

session_start();
session_destroy(); 

if(isset($_GET["Nome"])){$Nome=$_GET["Nome"];}
if(isset($_GET["Email"])){$Email=$_GET["Email"];}
if(isset($_GET["Senha"])){$Senha=$_GET["Senha"];}

// Consulta
try 
{
    if($nome == ''){
        $Matriz = $conexao->prepare("select Nome from Cliente");
        $Matriz = $conexao->prepare("select Email from Contato");
    }
    else{
        $Matriz = $conexao->prepare("select Nome, Email from Cliente, Contato where Nome = ?");
        $Matriz->bindParam(1, $nome);
    }

    $Matriz->execute();
    $Cliente = $Matriz->fetchAll();
    
    $ReturnJSON = json_encode($Cliente);

    echo $ReturnJSON;

} 
catch (PDOException $erro) 
{
    echo $ReturnJSON = "Erro: " . $erro->getMessage();
}

?>