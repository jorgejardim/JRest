<?php
namespace Model;

class Teste extends AppModel {

    public $table      = 'tests';
    public $primariKey = 'test_id';

    public $fields = array(
        'test_name' => array(
            'required' => 'O campo Nome é obrigatório',
        ),
        'test_email' => array(
            'required' => 'O campo E-mail é obrigatório',
            'validate' => array(
                'email' => 'O campo E-mail é inválido.',
            )
        ),
    );
}