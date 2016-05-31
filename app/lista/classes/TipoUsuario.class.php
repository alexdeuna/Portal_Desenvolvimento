<?php

require_once("base.class.php");

class TipoUsuario extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "tipoUsuario";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "tipo" => NULL

            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>