<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Categoria;

class CategoriaDAO extends Connection {

    public function getAll() {

        $query = 'select id, nome_categoria from categoria where user_id = :user_id';

        return $this->select($query, array(
            ':user_id' => $_SESSION['user_id']
        ));

    }

    public function show($id) {

        $query = 'select id, nome_categoria from categoria where id = :id and user_id = :user_id';

        return $this->select($query, array(
            ':id' => $id,
            ':user_id' => $_SESSION['user_id']
        ));

    }

    public function insert(Categoria $categoria) {

        $query = 'insert into categoria(nome_categoria, user_id) values(:nome, :user_id)';        

        $this->query($query, array(
            ':nome' => $categoria->__get('nome_categoria'),
            ':user_id' => $_SESSION['user_id']
        ));

    }

}