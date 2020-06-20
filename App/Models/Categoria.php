<?php

namespace App\Models;

class Categoria {

    private $id;
    private $nome_categoria;
    private $user_id;

    public function __get($params) {
        return $this->$params;
    }

    public function __set($params, $value) {
        $this->$params = $value;
    }   

}

?>