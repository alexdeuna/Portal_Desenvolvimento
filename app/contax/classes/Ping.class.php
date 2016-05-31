<?php

require_once("base.class.php");

class Ping extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "ping";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "texto" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>