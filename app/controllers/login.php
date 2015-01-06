<?php
namespace Controller;

class Login extends AppController {

    protected $models = array('Login');

    public function index($request) {

        unset($_SESSION['auth']);

        $result = $this->Login->login($request['email'], $request['password']);

        if(count($result)) {
            $_SESSION['auth']['user']['id']  = $result[0]['user_id'];
            $_SESSION['auth']['user']['name']  = $result[0]['user_name'];
            $_SESSION['auth']['token'] = $result[0]['user_token'];
            return array(
                    'id' => $result[0]['user_id'],
                    'name' => $result[0]['user_name'],
                    'token' => $result[0]['user_token'],
                    'msg' => 'Login realizado com sucesso.',
                    'return' => true
                );
        }

        return array(
                    'status' => 401,
                    'msg' => 'E-mail ou senha inválidos.',
                    'return' => false,
                    'error' => true
                );
    }

    public function logout() {

        unset($_SESSION['auth']);

        return array(
                'msg' => 'Logout realizado com sucesso.',
                'return' => true
            );
    }

    public function forgot_password($request) {

        $result = $this->Login->forgot_password($request['email']);

        if(count($result)) {

            $mail = new \Mail\Mail;

            $request['body'] = str_replace('{name}', $result[0]['user_name'], $request['body']);
            $request['body'] = str_replace('{email}', $result[0]['user_email'], $request['body']);
            $request['body'] = str_replace('{password}', $result[0]['user_password'], $request['body']);

            $mail->addTo($request['email']);
            $mail->setSubject($request['subject']);
            $mail->setHTMLBody($request['body'], false);

            $mail->send();

            return array(
                    'msg' => 'A senha foi enviada para seu e-mail.',
                    'return' => true
                );
        }

        return array(
                    'status' => 401,
                    'msg' => 'E-mail inválido.',
                    'return' => false,
                    'error' => true
                );
    }
}