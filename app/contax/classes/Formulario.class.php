<?php

require_once("base.class.php");

class Formulario extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "formulario";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "perfil" => NULL,
                "operador" => NULL,
                "login" => NULL,
                "ip" => NULL,
                "datahora" => NULL,
                "terminal" => NULL,
                "id_reclamacao" => NULL,
                "evento_reparo" => NULL,
                "alinhado_cci" => NULL,
                "parametro_cci" => NULL,
                "csc_funcionando" => NULL,
                "listado_csc" => NULL,
                "alinhado_csc" => NULL,
                "modelo_diferente" => NULL,
                "dispositivos_conectados" => NULL,
                "id_ping" => NULL,
                "acao" => NULL,
                "id_resolvido" => NULL,
                "obs" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>