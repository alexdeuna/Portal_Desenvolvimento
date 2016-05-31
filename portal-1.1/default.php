<?php
header("Content-Type: text/html; charset=UTF-8", true);
require_once("./classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>:: Portal de Aplicações OSS ::</title>
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js" async="TRUE"></script>
        <link href="./css/bootstrap.min.css" rel="stylesheet" />     
        <script src="./js/oi.js"></script>
        <script src="./js/jquery.chrony.min.js"></script>
        <link href="./css/oi.css" rel="stylesheet" />
        <link href="./css/jquery-ui.css" rel="stylesheet" />
        <script src="./js/jquery-ui.js"></script>
        <script src="./js/validator.js"></script>

    </head>
    <body>
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
                    <form class="navbar-form navbar-right">
                        <div class="form-group-sm">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['UsuarioNome']; ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Dados</a></li>
                                    <li><a href="#" id="ajuda-dialog-btn">Mudar Senha</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" id="sair-dialog-link">Sair</a></li>
                                    <li><a href="#" id="time"></a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-info" id="sair-dialog-link-btn">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair
                            </button> 
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <!--FIM NAVBAR-->      
        <!--CONTAINER-->
        <div class="container" style="margin-top:70px;">
            <?php
            if ($_GET['msg'] == "Senha Alterada!") {
                echo "<div class='oi-alert oi-alert-success' role='alert'>" . $_GET['msg'] . "</div>";
            }
            ?>
            <!--TOPO-->
            <div class="row espaco">
                <div class="col-lg-2">
                    <img class="img-responsive center-block" src="../bootstrap/img/logo-oi.png"/>
                </div>
                <div class="col-lg-10">
                    <div class="text-center oi-titulo">Portal de Aplicações</div>             
                </div>
            </div>
            <!--CONTEUDO-->
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" class="active"><a href="home.php?p=home">Home</a></li>
                        <?php
                        foreach ($_SESSION['Menu'] as $v1) {
                            if ($v1->idPai == 0) {
                                if ($v1->separador == 'n') {
                                    echo "<li role='presentation'><a href='home.php?p=" . $v1->pasta . "&t=" . $v1->nome . "&d=" . $v1->descricao . "'onclick='divNone()'>" . $v1->nome . "</a></li>";
                                } else {
                                    echo "<li role='presentation' class='dropdown'>"
                                    . "<a class='dropdown-toggle' data-toggle='dropdown' href='index.php' role='button' aria-expanded='false'>"
                                    . $v1->nome . "<span class='caret'>"
                                    . "</span>"
                                    . "</a> <ul class='dropdown-menu' role='menu'>";
                                    foreach ($_SESSION['Menu'] as $v2) {
                                        if ($v2->idPai == $v1->id) {
                                            //echo "<li role = 'presentation'><a href = '#'>" . $v1->id . $v1->idPai . $v1->nome . "</a></li >";
                                            echo "<li><a href='home.php?p=" . $v2->pasta . "&t=" . $v2->nome . "&d=" . $v2->descricao . "' onclick='divNone()'>" . $v2->nome . "</a></li>";
                                        }
                                    }
                                    echo "</ul>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-10 left"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading oi-titulo-app"><?php echo ($_GET['p'] != '') ? $_GET['t'] : "Home"; ?> </div>
                        <div class="panel-body">
                            <div id="carregando"> loading.....</div>
                            <div id="conteudo"> 
                                <?php
                                if ($_GET['p']) {
                                    include '../' . $_GET['p'] . '/index.php';
                                } else {
                                    echo "<img class='img-responsive center-block oi-logooss' src='../bootstrap/img/logo_oss_cor_150.gif'/>"
                                    . "<div class='text-center oi-texto'>Equipe de Plataformas SSO</div>"
                                    . "<div class='text-center oi-texto'>Gerência de Operações SSO</div>"
                                    . "<div class='text-center oi-texto'>Diretoria de Operações Centralizadas</div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class = "panel-footer "><?php echo ($_GET['p'] != '') ? $_GET['d'] : "Home"; ?> </div>
                    </div>
                </div>
                <!-- FIM CONTEUDO-->
                <!--RODAPE-->
                <div class="row">
                    <div class="col-lg-12 rodape navbar-fixed" align="center">
                        <img class="img-responsive center-block" src="../bootstrap/img/logo_oss_cor_50.gif"/>
                        © Copyright 2000-2014 <strong> Portal OSS </strong>Todos os direitos reservados.
                    </div>
                </div>
            </div>
            <!--FIM RODAPE-->
            <nav class="nav navbar-fixed-bottom oi-cor espaco"> </nav>
        </div>
        <!--FIM CONTAINER-->
        <!--Modal SAIR-->
        <div id="sair-dialog" title="Sair">
            <p>Deseja Fechar o Sistema?</p>
        </div>
        <!-- MODAL AJUDA -->
        <div id="ajuda-dialog" title="Ajuda">
            <form name="fajuda" action="" method="POST" role="form">
                <div class="form- form-group-sm">
                    <div class="form-group text-center">
                        <p>Digite seu login e seu email e reset seu acesso.</p>
                        <DIV class="espaco"></DIV>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" class="form-control" id="envia-login" placeholder="Autorizado">
                        </div> 

                        <div class="input-group input-group-sm espaco">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="email" class="form-control" id="envia-email" placeholder="Email">
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>