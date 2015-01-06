<?php
namespace Model;

class Login extends AppModel {

    public $table = 'users';

    public function login($email, $password) {

        $conditions = array(
                'user_email = ?' => $email,
                'user_password = ?' => $password
            );
        return $this->find($conditions);
    }

    public function forgot_password($email) {

        $conditions = array(
                'user_email = ?' => $email
            );
        return $this->find($conditions);
    }
}