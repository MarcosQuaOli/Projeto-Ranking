<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\User;

class UserDAO extends Connection {

    public function getUser(User $user) {

        $query = "select id, nome, email, senha from users where email = :email and senha = :senha";

        return $this->select($query, array(
            ':email' => $user->__get('email'),
            ':senha' => $user->__get('senha')
        ));

    }

    public function insert(User $user) {

        $query = 'insert into users(nome, email, senha) values(:nome, :email, :senha)';        

        $this->query($query, array(
            ':nome' => $user->__get('nome'),
            ':email' => $user->__get('email'),
            ':senha' => $user->__get('senha')
        ));

    }

    public function getEmail() {

        $query = 'select email from users';

        return $this->select($query);

    }

}

?>