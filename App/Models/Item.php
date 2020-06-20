<?php

namespace App\Models;

class Item {

    private $id;
    private $nome;
    private $posicao;
    private $categoria_id;
    private $user_id;

    public function __get($params) {
        return $this->$params;
    }

    public function __set($params, $value) {
        $this->$params = $value;
    }   

}

?>