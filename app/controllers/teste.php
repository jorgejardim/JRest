<?php
namespace Controller;

class Teste extends AppController {

    protected $models = array('Teste');

    public function index() {

        return array('return' => $this->Teste->all());
    }

    public function view($id) {

        $this->no_id($id);

        return array('return' => $this->Teste->get($id, $this->Teste->primariKey));
    }

    public function add($values) {

        return array('return' => $this->Teste->insert($values));
    }

    public function edit($values) {

        $this->no_id($values, $this->Teste->primariKey);

        $conditions = array(
                $this->Teste->primariKey.' = ?' => $values[$this->Teste->primariKey]
            );
        return array('return' => $this->Teste->update($values, $conditions));
    }

    public function delete($id) {

        $this->no_id($id);

        $conditions = array(
                $this->Teste->primariKey.' = ?' => $id
            );
        return array('return' => $this->Teste->delete($conditions));
    }
}