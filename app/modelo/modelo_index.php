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

<script src="../../app/XXX/js/XXX.js"></script>

<div id="container_XXX">

</div>