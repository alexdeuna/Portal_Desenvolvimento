<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu Dinâmico - Bootstrap</title>
        <style>
            .esconde {display:none;}
            .son{background-color: red;}
        </style>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>

    <?php
 //   ini_set("display_errors", 0);
    $con = mysql_connect("localhost", "root", "root") or die(mysql_error());
    mysql_select_db("portal");
    $nome = $_POST['nome'];

    $sql = mysql_query("SELECT * FROM aplicacao ORDER BY id DESC", $con) or die(mysql_error());

    ini_set('SMTP', "relay.telemar");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "email@domain.com");
    
$para = "alex.e@oi.net.br"; 
$nome = "teste"; 
$assunto = "teste"; 
$mensagem = "<strong>Nome: </strong>".$nome; 
$mensagem .= "<br> <strong>Mensagem: </strong>teste";
$headers = "Content-Type:text/html; charset=UTF-8\n"; 
$headers .= "From: dominio.com.br<sistema@dominio.com.br>\n"; 
$headers .= "X-Sender: <sistema@dominio.com.br>\n"; 
$headers .= "X-Mailer: PHP v".phpversion()."\n"; 
$headers .= "Return-Path: <sistema@dominio.com.br>\n"; 
$headers .= "MIME-Version: 1.0\n"; 

mail($para, $assunto, $mensagem, $headers); 


    ?>

    <body>

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <nav class="navbar navbar-inverse navbar-static-top nav-divider oi-navbar" role="navigation">
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

                <form name="f1" action="" method="POST" class="navbar-form navbar-right">
                    <div class="form-group-sm">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> wwwww   <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a data-toggle="modal" data-target="#myModalDados">Dados</a></li>
                                <li><a data-toggle="modal" data-target="#myModal">Mudar Senha</a>



                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Sair</a></li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-info" name="sair">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair
                        </button>
                    </div>
                </form>

            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            Meu menu
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">		<?php
            while ($cat = mysql_fetch_object($sql)) {
                echo '
			<li><a tabindex="-1" href="#">' . $cat->nome . '</a></li>';
            }
            ?>
            <li><a tabindex="-1" href="#">categoria 1</a></li>
            <li><a tabindex="-1" href="#">categoria 2</a></li>
            <li><a data-toggle="modal" data-target="#myModal"> Launch demo modal</a></li>
            <!-- dropdown menu links -->
        </ul>
    </div>
    <div class="container">

        <!--TOPO-->
        <div class="row espaco">
            <div class="col-lg-2">
                <img class="img-responsive" src="bootstrap/img/logo-oi.png"/>

            </div>
            <div class="col-lg-10">
                <div class="text-center oi-titulo">Portal de Aplicações</div>             
            </div>
        </div>
        <!--CONTEUDO-->
        <div class="row">
            <div class="col-lg-2">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="home.php">Home</a></li>
                    <?php
                    foreach ($_SESSION['Menu'] as $v1) {
                        if ($v1->idPai == 0) {
                            if ($v1->separador == 'n') {
                                echo "<li role='presentation'><a href='home.php?p=" . $v1->pasta . "/&t=" . $v1->nome . "'>" . $v1->nome . "</a></li>";
                            } else {
                                echo "<li role='presentation' class='dropdown'>"
                                . "<a class='dropdown-toggle' data-toggle='dropdown' href='index.php' role='button' aria-expanded='false'>"
                                . $v1->nome . "<span class='caret'>"
                                . "</span>"
                                . "</a> <ul class='dropdown-menu' role='menu'>";
                                foreach ($_SESSION['Menu'] as $v2) {
                                    if ($v2->idPai == $v1->id) {
                                        //echo "<li role = 'presentation'><a href = '#'>" . $v1->id . $v1->idPai . $v1->nome . "</a></li >";
                                        echo "<li><a href='home.php?p=" . $v2->pasta . "/&t=" . $v2->nome . "'>" . $v2->nome . "</a></li>";
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
                    <div class="panel-body altura">
                        <?php
                        if ($_GET['p']) {
                            include '../' . $_GET['p'] . '/index.php';
                        }
                        /* foreach ($_SESSION as $index => $data) {

                          echo $index, ' = ', $data, '<br>';
                          }

                          print_r($_SESSION['Menu']);

                          foreach ($_SESSION['Menu'] as $v) {
                          foreach ($v as $y) {
                          echo $y;
                          }echo "<br>";
                          } */

                        $time = time() / 60 / 60 / 60;
                        $micro = microtime();
                        session_cache_expire(1200);
                        session_start();
                        $inactive = session_cache_expire();
                        if (isset($_SESSION['start'])) {
                            $session_life = time() - $_SESSION['start'];
                            if ($session_life > $inactive) {
                                session_unset();
                                echo "Sessao Expirou";
                            }
                        }
                        $_SESSION['start'] = time();
                        echo "timer: " . $time;
                        echo "<br />microtimer: " . $micro;
                        ?>

                    </div>
                    <div class = "panel-footer ">Panel footer</div>
                </div>
            </div>
            <!-- FIM CONTEUDO-->
            <!--RODAPE-->
            <div class="row">
                <div class="col-lg-12 rodape" align="center">
                    <img class="img-responsive center-block" src="bootstrap/img/logo_oss_cor_50.gif"/>
                    © Copyright 2000-2014 <strong> Portal OSS </strong>Todos os direitos reservados.
                </div>
            </div>
        </div>
        <!--FIM RODAPE-->

    </div>

    <div class="form-group">
        <div class="form-group col-lg-6">
            <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
            <span class="help-block">Mínimo de 6 characters</span>
        </div>
        <div class="form-group col-sm-6">
            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirmar" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <script>
        function formatatempo(segs) {
            min = 0;
            hr = 0;
            while (segs >= 60) {
                if (segs >= 60) {
                    segs = segs - 60;
                    min = min + 1;
                }
            }
            while (min >= 60) {
                if (min >= 60) {
                    min = min - 60;
                    hr = hr + 1;
                }
            }
            if (hr < 10)
                hr = "0" + hr
            if (min < 10)
                min = "0" + min
            if (segs < 10)
                segs = "0" + segs
            fin = hr + ":" + min + ":" + segs
            if (min == 0 && segs == 0) {
                alert('acabou');
            } else {
                return fin;
            }
        }
        var segundos = 3; //inicio do cronometro
        function conta() {
            segundos--;
            document.getElementById("counter").innerHTML = formatatempo(segundos);
        }

        function inicia() {
            interval = setInterval("conta();", 1000);
        }

        function para() {
            clearInterval(interval);
        }

        function zera() {
            clearInterval(interval);
            segundos = 0;
            document.getElementById("counter").innerHTML = formatatempo(segundos);
        }
    </script>
</head>
<body>
    <span id="counter">00:00:00</span><br>
    <input type="button" value="Parar" onclick="para();"> <input type="button" value="Iniciar" onclick="inicia();"> <input type="button" value="Zerar" onclick="zera();">
</body>
</html>