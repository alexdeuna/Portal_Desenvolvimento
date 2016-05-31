<?php
require_once("./classes/base.class.php");
require_once("./classes/Usuario.class.php");

extract($_GET);
$t = (explode(",", $_GET['t']));

if ($_GET['msg'] == "") {
    $user = new Usuario();
    $user->extra_select = "WHERE id = " . $t[0] . " AND chave = '" . $t[2] . "';";
    $user->selecionaCampos($user);
    $resUser = $user->retornaDados();

    if (!$resUser->chave) {
        echo "<script>alert('Tente novamente, caso continue contacte o administrador!');</script>";
        exit();
    }
}
if (isset($_POST['reset-senha'])) {

    $atualizar = new Usuario();
    $atualizar->valor_pk = $_POST['id'];
    $atualizar->setValor('senha', $_POST['senha']);
    $atualizar->delCampo('login');
    $atualizar->delCampo('nome');
    $atualizar->delCampo('email');
    $atualizar->delCampo('ativo');
    $atualizar->delCampo('chave');
    $atualizar->delCampo('dataInsert');
    $ret = $atualizar->atualizar($atualizar);
    echo $ret . $_POST['id'] . " - -" . $_POST['senha'];
    if ($ret == 1) {
        header("Location: reset.php?msg=Senha Alterada!");
    } else {
        header("Location: reset.php?msg=ERRO Senha Alterada!");
    }
}
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>:: Portal de Aplicações OSS ::</title>
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js" async="TRUE"></script>
        <link href="./css/bootstrap.min.css" rel="stylesheet">     
        <script src="./js/jquery.chrony.min.js"></script>
        <script src="./js/oi.js"></script>
        <link href="./css/oi.css" rel="stylesheet">
        <link href="./css/jquery-ui.css" rel="stylesheet" />
        <script src="./js/jquery-ui.js"></script>
        <script src="./js/validator.js"></script>
    </head>
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-top nav-divider oi-navbar" role="navigation">
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
            </div><!-- /.container-fluid -->
        </nav>
        <!--FIM NAVBAR--> 
        <!--CONTAINER-->
        <div class="container oi-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info"  style="margin: 18%;">
                        <div class="panel-heading" style="height: 200px;">
                            <form data-toggle="validator" role="form" method="POST" action="">
                                <div class="form-group">
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                                        <span class="help-block">Mínimo de 6 characters</span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Repita</label>
                                        <input type="password" name="senha" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="As senhas não estão iguai!" placeholder="Confirmar" required>
                                        <div class="help-block with-errors"></div>
                                        <INPUT type="hidden" name="id" value="<?php echo $t[0]; ?>">
                                        <INPUT type="hidden" name="mail" value="<?php echo $t[1]; ?>">
                                        <INPUT type="hidden" name="chave" value="<?php echo $t[2]; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary" name="reset-senha">Atualizar
                                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                                    </button>
                                    <?php echo $msg; ?>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- FIM CONTEUDO-->
            <!--RODAPE-->
            <div class="row">
                <div class="col-lg-12 rodape oi-fixo" align="center">
                    <img class="img-responsive center-block" src="./img/logo_oss_cor_50.gif"/>
                    © Copyright 2000-2014 <strong> Portal OSS </strong>Todos os direitos reservados.
                </div>
            </div>
            <!--FIM RODAPE-->
        </div>
        <nav class="navbar-fixed-bottom oi-cor espaco"></nav>
        <!--FIM CONTAINER-->
    </body>
</html>