<?php
require_once("../../web/classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
echo "<input type='hidden' id='SESSION_UsuarioID' value='" . $_SESSION['UsuarioID'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioLogin' value='" . $_SESSION['UsuarioLogin'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioNome' value='" . $_SESSION['UsuarioNome'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioPerfil' value='" . $_SESSION['UsuarioPerfil'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioIP' value='" . $_SESSION['IP'] . "'>";

//echo $_SESSION['UsuarioNome'];
?>

<script src="../app/contax/js/jquery.mask.js" ></script>
<script src="../app/contax/js/contax.js"></script>

<div id="container_contax">
    <div class="help-block text-right total_preenchido"></div>
    <form name="f" id="f" action="" method="POST" class="" role="form">
        <div class="form-group col-sm-4 terminal">  
            <label class="help-block">DDD + Terminal</label>
            <input type="tel" class="form-control" id="terminal" placeholder="(xx)xxxx-xxxx">
        </div>

        <div class="form-group col-sm-4 reclamacao">
            <label class="help-block">Reclamação / Solicitação do Cliente</label>
            <select class="form-control" id="reclamacao">
            </select>
        </div>

        <div class="form-group text-center col-sm-4 evento_reparo">
            <label class="help-block">Existe Evento ou Reparo aberto?</label>
            <select class="form-control" id="evento_reparo">
                <option value="s">Sim</option>
                <option value="n">Não</option>
            </select>
        </div>
        <!--============================================================================================-->
        <div class="form-group text-center col-sm-4 alinhado_cci">
            <label class="help-block">Modem alinhado no CCI?</label>
            <div class="radio-inline">
                <label><input type="radio" name="alinhado_cci" value="s" id="alinhado_cci_Sim">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="alinhado_cci" value="n" id="alinhado_cci_Nao">Não</label>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 parametro_cci">
            <label class="help-block">Parâmetros OK no CCI?</label>
            <div class="radio-inline">
                <label><input type="radio" name="parametro_cci" value="s" id="parametro_cci_Sim">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="parametro_cci" value="n" id="parametro_cci_Nao">Não</label>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 csc_funcionando">
            <label class="help-block">CSC funcionando corretamente?</label>
            <div class="radio-inline">
                <label><input type="radio" name="csc_funcionando" value="s" id="csc_funcionando_Sim">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="csc_funcionando" value="n" id="csc_funcionando_Nao">Não</label>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 listado_csc">
            <label class="help-block">Modem é listado no CSC?</label>
            <div class="radio-inline">
                <label><input type="radio" name="listado_csc" value="s" id="listado_csc_Sim">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="listado_csc" value="n" id="listado_csc_Nao">Não</label>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 alinhado_csc">
            <label class="help-block">Modem alinhado no CSC?</label>
            <div class="radio-inline">
                <label><input type="radio" name="alinhado_csc" value="s" id="alinhado_csc_Sim">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="alinhado_csc" value="n" id="alinhado_csc_Nao">Não</label>
            </div>
        </div>
        <div class="form-group text-center col-sm-4 modelo_diferente">
            <label class="help-block">Diferença no modelo do modem?</label>
            <div>
                <div class="radio-inline">
                    <label><input type="radio" name="modelo_diferente" value="s">Sim</label>
                </div>
                <div class="radio-inline">
                    <label><input type="radio" name="modelo_diferente" value="n">Não</label>
                </div>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 dispositivos_conectados">
            <label class="help-block">Verificou se há dispositivos conectados?</label>
            <div class="radio-inline">
                <label><input type="radio" name="dispositivos_conectados" value="s">Sim</label>
            </div>
            <div class="radio-inline">
                <label><input type="radio" name="dispositivos_conectados" value="n">Não</label>
            </div>
        </div>

        <div class="form-group text-center col-sm-4 ping">
            <label class="help-block">Teste Ping Executado?</label>
            <select class="form-control" id="ping">
            </select>
        </div>

        <div class="form-group col-sm-12 como_resolvido">
            <label class="help-block">Como foi Resolvido? (Presione o CTRL para mais de uma opção).</label>
            <select multiple size="9" class="form-control" id="como_resolvido">
            </select>
        </div>

        <div class="form-group text-center col-sm-12 foi_resolvido">
            <label class="help-block">Foi resolvido?</label>
            <select class="form-control" id="foi_resolvido">
            </select>
        </div>

        <div class="form-group col-sm-12 obs">  
            <label class="help-block">Observação</label>
            <textarea  class="form-control" id="obs" placeholder="Observação" maxlength="500"></textarea>
            <div class="help-block text-right" id="caracteres">500</div>
        </div>


        <div class="form-group col-sm-12 text-center cadastrar">
            <button type="button" class="btn btn-default" id="cadastrar" >Cadastrar</button>
        </div>
    </form>
</div>