<?php
require_once("../../portal/classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
//echo $_SESSION['UsuarioNome'];
?>

<script src="../portalapp/lista/js/pass.js"></script>
<link rel="stylesheet" type="text/css" href="../portalapp/lista/css/flexigrid.pack.css" />
<script type="text/javascript" src="../portalapp/lista/js/flexigrid.pack.js"></script>
<script type="text/javascript" src="../portalapp/lista/js/flexi.js"></script>

<table class="flexme4" style="display: none"></table>

<div id="container_pass">

</div>
<!-- Modal -->
<div id="dialog-edita-usuario" role="dialog" title="Editar">
    <form name="fajuda" action="" method="POST" role="form">
        <div class="form form-group-sm">
            <div class="form-group text-center">
                <p>Digite seu login e seu email e reset seu acesso.</p>
                <DIV class="espaco"></DIV> <input type="hidden" id="id_fornecedor">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope">FORNECEDOR</span>
                    </span>
                    <input type="text" class="form-control" id="nome_fornecedor">
                </div><br>
                <input type="hidden" id="id_plataforma">
                Plataforma <input type="text" id="nome_plataforma"> <br>
                <input type="hidden" id="id_servidor">
                Hostname <input type="text" id="hostname"><br>
                IP <input type="text" id="ip">
                Porta <input type="text" id="porta"><br>
                <input type="hidden" id="id_so">
                SO<input type="text" id="nome_so"> <br>
                <input type="hidden" id="id_usuario">
                Usuario <input type="text" id="usuario"><br>
                <input type="hidden" id="id_tipo">
                Tipo <input type="text" id="tipo"><br>
                Senha<input type="text" id="senha1"> 
                <input type="hidden" id="senha2"><br>
                <input type="hidden" id="senha3">
                Descrição<input type="text" id="desc">
            </div>
        </div>
    </form>
</div>