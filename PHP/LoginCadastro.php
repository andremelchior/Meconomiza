<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Projeto Meconomiza</title>
    <link rel="shortcut icon" type="image/png" href="../IMG/favicon.ico" sizes="32x32">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <?php
        include "conexao.php";
        session_start();
        session_destroy(); 
    ?>
    <div class="container">
        <div class="content first-content">
            <div class="primeira-coluna">
                <h2 class="title title-primary" id="return" >Bem vindo!</h2>
                <p class="description description-primary" id="resposta"></p>
                <p class="description description-primary">Para continuar conectado</p>
                <p class="description description-primary">Por favor, logue com seus dados</p>
                <button id="signin" class="btn btn-primary">ENTRAR</button>
            </div>    
            <div class="segunda-coluna">
                <h2 class="title title-second">criar conta</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>        
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div><!-- social media -->

                <p class="description description-second">ou use seu email para registro:</p>

                <form class="form" id="Cadastro" action="" method="GET" name="Cadastro">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input style="outline: none;" type="text" id="Nome" placeholder="Nome" name="Nome">
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input style="outline: none;" type="email" id="Email" placeholder="Email" name="Email">
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input style="outline: none;" type="password" id="Senha" placeholder="Senha" name="Senha">
                    </label>
                    
                    <input class="btn btn-second" id="Cadastrar" type="submit" id="Cadastrar" value="Cadastrar">
                    <input class="btn btn-second" id="Consultar" type="submit" id="Consultar" value="Consultar">
                    <input class="btn btn-second" type="reset" value="Limpar">
                </form>
            </div> <!-- segunda coluna -->

            <!-- <h2>Returno do JSON</h2> -->

        </div> <!-- primeiro content -->
        <div class="content second-content">
            <div class="primeira-coluna">
                <h2 class="title title-primary">Olá, amigo!</h2>
                <p class="description description-primary">Insira seus dados pessoais</p>
                <p class="description description-primary">e comece sua jornada conosco</p>
                <button id="signup" class="btn btn-primary">CADASTRE-SE!</button>
            </div>
            <div class="segunda-coluna">
                <h2 class="title title-second">Entrar no MECONOMIZA</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div><!-- social media -->
                <p class="description description-second">ou use seu email cadatrado:</p>

                <form class="form" id="" action="">
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input style="outline: none;" type="email" placeholder="Email">
                    </label>
                
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input style="outline: none;" type="password" placeholder="Senha">
                    </label>
                
                    <a class="password" href="#">esqueceu a senha?</a>
                    <button class="btn btn-second">ENTRAR</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- second-content -->
    </div>
    <!-- <button class="btn btn-second2">VOLTAR</button> -->

    <script src="../js/app.js"></script>
   
</body>
</html>

<script>

    $(document).ready(function() {

        $('#Cadastrar').click(function() {

            var dados = $('#Cadastro').serialize();

            $.ajax({

                method: 'GET',
                url: 'inclusao.php',
                data: dados,

                beforeSend: function(){
                    $('#return').html("Processando...");

                }
            })

            .done(function(msg){

                $('#return').html("Retorno do cadastro...");
                $("#resposta").html(msg);

                window.alert("Cadastrado com sucesso!");
            })

            .fail(function(){

                window.alert("Erro! Não houve sucesso no cadastro, tente novamente.");

            })

            return false;
        })


    })

    $(document).ready(function() {

        $('#Consultar').click(function(){

            var dados = $('#Cadastro').serialize();

            $.ajax({

                method: 'GET', 
                url: 'consulta.php',
                data: dados,

                beforeSend: function(){

                    $("h2").html("Processando a consulta...");

                }
            })

            .done(function(msg){

                $("h2").html("Dados da consulta...");

                var Cliente = JSON.parse(msg);

                var Bloco = '';
                Bloco += "Nome: " + Cliente[1].nome + "<br>";
                Bloco += "Email: " + Cliente[1].email + "<br>";
                Bloco += "<hr>";

                $("#resposta").append(Bloco);
            
            })

            .fail(function(){

                window.alert("Erro! Não houve sucesso no cadastro, tente novamente.");

            })

            return false;
            
        })

    })

</script>