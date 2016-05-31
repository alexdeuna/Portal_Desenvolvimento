<?php

require_once("base.class.php");

class Equipe extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "equipe";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "nome" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>