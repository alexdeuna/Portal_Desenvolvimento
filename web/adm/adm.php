<?php
require_once("../classes/Validacao.class.php");
require_once("../classes/base.class.php");
require_once("../classes/Usuario.class.php");
require_once("../classes/Menu.class.php");
require_once("../classes/Aplicacao.class.php");
$validar = new Validacao();
$s = new Validacao();
$validar->validar(addslashes($_POST['login_adm']), addslashes($_POST['senha_adm']));
$s->verifica(12000);
//echo "sssss!" . $_SESSION['UsuarioLogin'];
if ($_SESSION['UsuarioLogin'] != "admin") {
    echo "Login e senha inválidos!" . $_SESSION['UsuarioLogin'];
    exit();
}
?>
<HTML>
    <head>
        <meta http-equiv="Content-Type" content="text / html; charset = UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE = edge">
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>:: Portal de Aplicações OSS ::</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" />  
        <link href="../css/oi.css" rel="stylesheet" />
        <link href="../css/jquery-ui.css" rel="stylesheet" />
        <link href="./adm.css" rel="stylesheet" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js" async="TRUE"></script>
        <script src="../js/jquery.chrony.min.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/validator.js"></script>
        <script src="./adm.js"></script>

    </head>
    <body>
        <div class="container-fluid">
            <h3>Portal OSS</h3>
            <p>Adminstração:</p>      
            <div class="row">
                <div class="col-xs-12">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Usuário</a></li>
                            <li><a href="#tabs-2">Aplicação</a></li>
                            <li><a href="#tabs-3">Log</a></li>
                        </ul>
                        <div id="tabs-1">
                            <h3>Usuário</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div id="accordion_user">
                                            <h3 id="usuario_cad">Cadastro</h3>
                                            <div>
                                                <form class="form" role="form" name="fadduser" id="fadduser" action="" method="POST" >
                                                    <div class="form-group-lg">
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-font"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="login_manter" placeholder="ID Autorizado" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="perfil" placeholder="Perfil" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-user"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="nome" placeholder="Nome" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-envelope"></span>
                                                                </span>
                                                                <input type="email" class="form-control" id="email" placeholder="E-Mail" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-earphone"></span>
                                                                </span>
                                                                <input type="tel" class="form-control" id="tel" placeholder="Telefone">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="obs" placeholder="Observações">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions  col-lg-12">
                                                        <input type="hidden" id="id_usuario">
                                                        <button type="submit" class="btn btn-primary" id="cadastrar_user" value="Cadastrar">Cadastrar</button>
                                                        <button type="submit" class="btn btn-warning" id="atualizar_user" value="Atualizar">Atualizar</button>
                                                        <button type="reset" class="btn btn-danger" id="limpar_user" value="Limpar">Limpar</button>
                                                    </div> 
                                                </form>
                                            </div>
                                            <h3 id="usuario_permissao">Acesso</h3>
                                            <div>
                                                <form class="form" role="form" name="fpermissao" >
                                                    <div class="controls controls-row">
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-font"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="login_permissao" placeholder="ID Autorizado" required>      
                                                            </div>
                                                        </div>
                                                        <div  class="form-group col-lg-12">Sistemas:
                                                            <div class="form-group  col-lg-12" id="sistemas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div id="tabs-2">
                            <h3>Aplicação</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div id="accordion_app">
                                            <h3>Cadastro</h3>
                                            <div>
                                                <form class="form" role="form" name="faddapp" id="faddapp" action="" method="POST" >
                                                    <div class="form-group-lg">
                                                        <div class="form-group col-lg-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </span>
                                                                <input type="checkbox" class="form-control" id="separador">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-font"></span>
                                                                </span>
                                                                <input type="text" class="form-control" id="nome_app" placeholder="Aplicação" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </span>
                                                                <input type="checkbox" class="form-control" id="obs" placeholder="Observações">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions  col-lg-12">
                                                        <input type="hidden" id="id_usuario">
                                                        <button type="submit" class="btn btn-primary" id="cadastrar_user" value="Cadastrar">Cadastrar</button>
                                                        <button type="submit" class="btn btn-warning" id="atualizar_user" value="Atualizar">Atualizar</button>
                                                        <button type="reset" class="btn btn-danger" id="limpar_user" value="Limpar">Limpar</button>
                                                    </div> 
                                                </form>                                            </div>
                                            <h3>Acesso</h3>
                                            <div>
                                                <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div id="tabs-3">
                            <h3>Log</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="column">
                                            <div class="portlet">
                                                <div class="portlet-header">Feeds</div>
                                                <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
                                            </div>
                                            <div class="portlet">
                                                <div class="portlet-header">News</div>
                                                <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div class="portlet">
                                                <div class="portlet-header">Shopping</div>
                                                <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
                                            </div>
                                            <div class="portlet">
                                                <div class="portlet-header">Links</div>
                                                <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
                                            </div>
                                            <div class="portlet">
                                                <div class="portlet-header">Images</div>
                                                <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>