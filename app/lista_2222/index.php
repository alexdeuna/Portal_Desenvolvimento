<?php
require_once("../../portal/classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
//echo $_SESSION['UsuarioNome'];
?>
<script src="../portalapp/lista/js/pass.js"></script>
<div id="container_pass">
<!--    <ul class='list-group' tipo='fornecedor'> 
        <li class='list-group-item'  nivel='1'>
            <span></span>
            <button type='button' class='btn btn-primary' tipo = 'fornecedor'>
                <span class='glyphicon glyphicon-edit'></span>
            </button>
        </li>
        <ul class='list-group-item' tipo='plataforma'>
            <li class='list-group-item'  nivel='2' id="plataforma">
                <span></span>
                <button type='button' class='btn btn-danger' tipo = 'btn_remove_plataforma'>
                    <span class='glyphicon  glyphicon-remove'></span>
                </button>
                <button type='button' class='btn btn-primary' tipo = 'btn_altera_plataforma'>
                    <span class='glyphicon glyphicon-pencil'></span>
                </button>
            </li>
            <ul class='list-group-item' tipo='servidor'>
                <li class='list-group-item' nivel='3' id="servidor">
                    <span></span>
                    <button type='button' class='btn btn-danger' tipo = 'btn_remove_plataforma'>
                        <span class='glyphicon  glyphicon-remove'></span>
                    </button>
                    <button type='button' class='btn btn-primary' tipo = 'btn_altera_plataforma'>
                        <span class='glyphicon glyphicon-pencil'></span>
                    </button>
                </li>
                <ul class='list-group-item' tipo='usuario'>
                    <li class='list-group-item' id='lista'>
                        <div>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Atual</th>
                                        <th>Anterior</th>
                                        <th>Antiga</th>
                                        <th>Descrição</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="usuario"></td>
                                        <td>$senha1</td>
                                        <td>$senha2</td>
                                        <td>$senha3</td>
                                        <td>$desc</td>
                                        <td>
                                            <button type='button' class='btn btn-primary' tipo = 'btn_edita_usuario'>
                                                <span class='glyphicon glyphicon-edit'>

                                                </span>
                                            </button>
                                        </td>
                                        <td>
                                            <button type='button' class='btn btn-danger' tipo = 'btn_exclui_usuario'>
                                                <span class='glyphicon glyphicon-trash'>

                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </ul>
        </ul>
    </ul>-->
</div>