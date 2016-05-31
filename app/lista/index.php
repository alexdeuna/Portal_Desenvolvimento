<?php
require_once("../../web/classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
echo "<input type='hidden' id='SESSION_UsuarioID' value='" . $_SESSION['UsuarioID'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioLogin' value='" . $_SESSION['UsuarioLogin'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioNome' value='" . $_SESSION['UsuarioNome'] . "'>";

//echo $_SESSION['UsuarioNome'];
?>

<script src="../app/lista/js/pass.js"></script>

<div id="container_pass">

</div>
<!-- Modal Editar-->
<div id="dialog-edita-usuario" class="dialog-edita-usuario" role="dialog" title="Editar">
    <form name="feditar" action="" method="POST" role="form">
        <div class="form">  
            <table class="table">
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="fornecedor">Fornecedor:</label>
                            <select type="text" class="form-control" id="nome_fornecedor"></select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="plataforma">Plataforma:</label>
                            <select type="text" class="form-control" id="nome_plataforma"></select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="hostname">Hostname:</label>
                            <input type="text" class="form-control" id="hostname">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <input type="text" class="form-control" id="ip">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="porta">Porta:</label>
                            <input type="text" class="form-control" id="porta">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="so">SO:</label>
                            <select type="text" class="form-control" id="nome_so"></select>
                        </div>
                    <td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="usuario">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <select type="" class="form-control" id="nome_tipo"></select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="text"class="form-control"  id="senha1"> 
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" class="form-control" id="descricao">
                            <input type="hidden" id="id_fornecedor">
                            <input type="hidden" id="id_plataforma">
                            <input type="hidden" id="id_servidor">
                            <input type="hidden" id="id_so">
                            <input type="text" id="id_usuario">
                            <input type="hidden" id="id_tipo">
                            <input type="hidden" id="senhaTMP">
                            <input type="hidden" id="senha2">
                            <input type="hidden" id="senha3">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="log">Última atualização:</label>
                            <span id="servidor_data_update"></span> <div id="servidor_log"></div>
                            <!--<span id="usuario_data_update"></span> <span id="usuario_log"></span>-->
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<!-- Modal Detalhes-->
<div id="dialog-detalhes-usuario" role="dialog" title="Detalhes">
    <table class="table table-hover">
        <tr>
            <th style="text-align: right">Fornecedor:</th>
            <td><span id="d_nome_fornecedor"></span></td>
            <th style="text-align: right">Plataforma:</th>
            <td><span id="d_nome_plataforma"></span></td>

        </tr>
        <tr>
            <th style="text-align: right">Hostname:</th>
            <td><span id="d_hostname"></span></td>
            <th style="text-align: right">IP:</th>
            <td><span id="d_ip"></span></td>
        <tr>
            <th style="text-align: right">Porta:</th>
            <td><span id="d_porta"></span></td>
            <th style="text-align: right">SO:</th>
            <td><span id="d_nome_so"> </span></td>
        </tr>
        <tr>
            <th style="text-align: right">Usuário:</th>
            <td><span id="d_usuario"></span></td>
            <th style="text-align: right">Tipo Usuário:</th>
            <td><span id="d_tipo"></span></td>
        </tr>
        <tr>
            <th style="text-align: right">Descrição:</th>
            <td colspan="3"><span id="d_descricao"></span></td>
        </tr>

    </table>
</div>