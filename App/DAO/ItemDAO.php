<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Item;

class ItemDAO extends Connection {
    
    public function getAll() {

        $query = 'SELECT * FROM itens where user_id = :user_id ORDER BY posicao';

        return $this->select($query, array(
            ':user_id' => $_SESSION['user_id']
        ));

    }
    
    public function show($id) {

        $query = 'SELECT * FROM itens WHERE categoria_id = :id and user_id = :user_id ORDER BY posicao';

        return $this->select($query, array(
            ':id' => $id,
            ':user_id' => $_SESSION['user_id']
        ));

    }
    
    public function insert(Item $item) {

        $query = 'INSERT INTO itens(nome, categoria_id, posicao, user_id)VALUES(:nome, :categoria_id, :posicao, :user_id)';

        $this->query($query, array(
            ':nome' => $item->__get('nome'),
            ':categoria_id' => $item->__get('categoria_id'),
            ':posicao' => $item->__get('posicao'),
            ':user_id' => $_SESSION['user_id']
        ));

    }
    
    public function update(Item $item, $posicaoTarget) {

        $query = "UPDATE itens SET posicao = :posicao WHERE posicao = :posicao_target AND categoria_id = :categoria_id and user_id = :user_id; ";
        $query .= "UPDATE itens SET posicao = :posicao_target WHERE id = :id AND categoria_id = :categoria_id and user_id = :user_id";

        $this->query($query, array(
            ':id' => $item->__get('id'),
            ':categoria_id' => $item->__get('categoria_id'),
            ':posicao' => $item->__get('posicao'),
            ':user_id' => $_SESSION['user_id'],
            ':posicao_target' => $posicaoTarget
        ));

    }
    
    public function delete(Item $item) {

        $query = 'DELETE FROM itens WHERE id = :id and user_id = :user_id';

        $this->query($query, array(
            ':id' => $item->__get('id'),
            ':user_id' => $_SESSION['user_id']
        ));

    }

}