<?php

require_once("base.class.php");

class Servidor extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "servidor";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "id_plataforma" => NULL,
                "id_so" => NULL,
                "hostname" => NULL,
                "ip" => NULL,
                "porta" => NULL,
                "data_insert" => NULL,
                "data_update" => NULL,
                "log" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>