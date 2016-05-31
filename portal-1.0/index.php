<?php
header("Content-Type: text/html; charset=UTF-8", true);
require_once("classes/Validacao.class.php");


if (isset($_POST['acessar'])) {
    $validar = new Validacao();
    $validar->validar(addslashes($_POST['login']), addslashes($_POST['senha']));
}


if (isset($_POST['senha'])) {
    
    header("Location: index.php?msg=Email Enviado!");
}
?>
<!DOCTYPE HTML>
<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>:: Portal de Aplicações OSS ::</title>

        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">     
        <link href="../bootstrap/css/oi.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once("./modal.php"); ?>
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-fixed-top nav-divider oi-navbar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand oi-navbar-brand">Portal OSS</a>
                </div> 
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li> <?php
        if ($_GET['msg']) {
            if (($_GET['msg'] == "Sessao Encerrada") || ($_GET['msg'] == "Email Enviado")) {
                echo "<!--<div class='oi-alert oi-alert-success' role='alert' style='margin:3px 0 0 0; padding: 10px 25em'>" . $_GET['msg'] . "</div>-->";
            } else {
                echo "<!--<div class='oi-alert oi-alert-danger' role='alert'>" . $_GET['msg'] . "</div>-->";
            }
        }
        ?></li>
                    </ul>
                    <form name="f1" action="" method="POST" class="navbar-form navbar-right">
                        <div class="form-group-sm">
                            <div class="form-group col-sm-12">
                                <input type="text" class="form-control" name="login" placeholder="Autorizado" required>
                                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                                <button type="submit" class="btn btn-primary btn-sm" name="acessar"> 
                                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Acessar
                                </button>
                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myModalAjuda">Ajuda
                                    <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>     </button>
                                <?php
                                if ($_GET['msg']) {
                                    if ($_GET['msg'] == "Sessao Encerrada!") {
                                        echo "<span class='help-block with-errors oi-alert oi-alert-success' role='alert'>" . $_GET['msg'] . "</span>";
                                    } elseif ($_GET['msg'] == "Email Enviado!") {
                                        echo "<span class='help-block with-errors oi-alert oi-alert-info' role='alert'>" . $_GET['msg'] . "</span>";
                                    } else {
                                        echo "<span class='help-block with-errors oi-alert oi-alert-danger' role='alert'>" . $_GET['msg'] . "</span>";
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->

        </nav>
        <!--FIM NAVBAR--> 
        <!--CONTAINER-->
        <div class="container oi-container" style="margin-top:75px;">
            <!--TOPO-->
            <div class="row espaco">
                <div class="col-lg-2">
                 <!--   <img class="img-responsive" src="../bootstrap/img/logo-oi.png"/> -->
                </div>
                <div class="col-lg-8">
                    <div class="text-center oi-titulo">Portal de Aplicações</div>             
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <!--CONTEUDO-->
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive center-block oi-logooss" src="../bootstrap/img/logo_oss_cor_150.gif"/>
                    <div class="text-center oi-texto">Equipe de Plataformas SSO</div>      
                    <div class="text-center oi-texto">Gerência de Operações SSO</div>      
                    <div class="text-center oi-texto">Diretoria de Operações Centralizadas</div>      
                </div>
            </div>
            <div class="row espaco">
                <div class="col-lg-6">

                    <div class="alert alert-danger oi-texto-ajuda">Solicitação de acesso <a href="../bootstrap/arquivos/POP_Solicitacao_Acesso_portal.pdf"  class="alert-link" target="_blank">clique aqui!</a></div>      
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-info oi-texto-ajuda">Dúvidas? <a href="mailto:PP-SegurancadeacessoOSS@oi.net.br?Subject=Dúvidas%20Portal%20OSS" class="alert-link"> PP-SegurancadeacessoOSS@oi.net.br </a> </div>      
                </div>
            </div>

            <!-- FIM CONTEUDO-->
            <!--RODAPE-->
            <div class="row">
                <div class="col-lg-12 rodape" align="center">
                    <img class="img-responsive center-block" src="../bootstrap/img/logo_oss_cor_50.gif"/>
                    © Copyright 2000-2014 <strong> Portal OSS </strong>Todos os direitos reservados.
                </div>
            </div>
            <!--FIM RODAPE-->
        </div>
        <nav class="navbar-fixed-bottom oi-cor espaco"></nav>
        <!--FIM CONTAINER-->
        <script src="../bootstrap/js/jquery.min.js" async="TRUE"></script>
        <script src="../bootstrap/js/bootstrap.min.js" async="TRUE"></script>

    </body>
</html>