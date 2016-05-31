<!--Modal Dados-->
<div class="modal fade" id="myModalDados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Dados</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Senha-->
<?php
if (isset($_POST['mudarsenha'])) {
    $atualizar = new Usuario();
    $atualizar->valor_pk = $_SESSION['UsuarioID'];
    $atualizar->setValor('senha', $_POST['senha']);
    $atualizar->delCampo('login');
    $atualizar->delCampo('nome');
    $atualizar->delCampo('email');
    $atualizar->delCampo('ativo');
    $atualizar->delCampo('chave');
    $atualizar->delCampo('dataInsert');
    $ret = $atualizar->atualizar($atualizar);
    echo "cssfd: " . $ret;
    if ($ret == 0) {
        header("Location: home.php?msg=Senha Alterada!");
    }
}
?>
<div class="modal fade" id="myModalSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <form data-toggle="validator" role="form" method="POST" action="">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mudança de Senha</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group col-sm-6">
                            <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                            <span class="help-block">Mínimo de 6 characters</span>

                        </div>
                        <div class="form-group col-sm-6">
                            <input type="password" name="senha" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="As senhas não estão iguai!" placeholder="Confirmar" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <br /> <br /> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" name="mudarsenha">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Ajuda-->
<div class="modal fade" id="myModalAjuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajuda</h4>
            </div>
            <div class="modal-body">
                <form name="fsenha" action="" method="POST" data-toggle="validator" role="form">
                    <button type="submit" name="senha" class="btn btn-danger center-block">Esqueci a senha</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--Modal Senha-->
<div class="modal fade" id="myModalSenha" tabindex="-10" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajuda</h4>
            </div>
            <div class="modal-body">
               Acesse seu e-mail
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Sessao-->
<div class="modal fade" id="myModalSessao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <form name="f1" action="" method="POST" data-toggle="validator" role="form">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Fechar</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">Deseja realmente fechar o sistema?</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="sair" class="btn btn-default">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </form>
        </div>
    </div>
</div>
