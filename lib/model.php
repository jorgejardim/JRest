<?php
namespace Model;

use Respect\Validation\Validator as validate;

class Model {

    public $db;
    public $table;
    public $function;
    public $valid = array();

    public function __construct($db, $function) {
        $this->db = $db;
        $this->function = $function;
        $this->db->debug = array($this, 'debug');
    }

    public function all($order=null, $limit=20, $table=null) {

        $table = $table?$table:$this->table;
        return $this->db->{$table}()
                                    ->order($order)
                                    ->limit($limit);
    }

    public function find($conditions=null, $order=null, $limit=20, $table=null) {

        $table = $table?$table:$this->table;
        return $this->db->{$table}()
                                    ->where($conditions)
                                    ->order($order)
                                    ->limit($limit);
    }

    public function get($id, $field='id', $table=null) {

        $table = $table?$table:$this->table;
        $return = $this->db->{$table}("$field = ?", $id)->limit(1);

        if($return)
            return $return[0];

        return false;
    }

    public function insert($values, $only_fields=null, $table=null) {

        $values = $this->validate($values);

        $table = $table?$table:$this->table;

        if($only_fields) {
            foreach ($only_fields as $field) {
                unset($values[$field]);
            }
        }

        $insert = $this->db->{$table}()->insert($values);

        if($insert)
            return $insert['id'];

        return $insert;
    }

    public function update($values, $conditions=null, $only_fields=null, $table=null) {

        $values = $this->validate($values, 'update');

        $table = $table?$table:$this->table;

        if($only_fields) {
            foreach ($only_fields as $field) {
                unset($values[$field]);
            }
        }

        return $this->db->{$table}()
                                    ->where($conditions)
                                    ->update($values);
    }

    public function delete($conditions, $table=null) {

        $table = $table?$table:$this->table;

        return $this->db->{$table}()
                                    ->where($conditions)
                                    ->delete();
    }

    public function exist($value, $field='id', $id='id', $table=null) {

        $table = $table?$table:$this->table;

        $result = $this->db->{$table}("$field = ?", $value)
                                                           ->select($id)
                                                           ->limit(1);
        if(count($result))
            return $result[0][$id];

        return false;
    }

    public function listing($conditions=null, $index='id', $value='name', $order=null, $limit=20, $table=null) {

        $table = $table?$table:$this->table;

        return $this->db->{$table}()
                                    ->where($conditions)
                                    ->order($order)
                                    ->limit($limit)
                                    ->fetchPairs($index, $value);
    }

    public function validate($values, $type='insert') {

        foreach ($this->fields as $field => $options) {

            if(isset($values[$field])) {

                //required
                if(isset($options['required'])) {
                    if(empty ($values[$field])) {
                        $this->valid[] = $options['required'];
                    }
                }

                //validates
                if(isset($options['validate'])) {
                    foreach ($options['validate'] as $rule => $msg) {
                        if(!validate::$rule()->validate($values[$field])) {
                            $this->valid[] = $msg;
                        }
                    }
                }

            } elseif(!isset($values[$field]) && $type=='insert') {

                $this->valid[] = $options['required'];
            }

            //created
            if($field=='created' && !isset($values[$field]) && $type=='insert') {
                $values['created'] = date('Y-m-d H:i:s');
            }

            //modified
            if($field=='modified' && !isset($values[$field])) {
                $values['modified'] = date('Y-m-d H:i:s');
            }
        }

        if(!empty($this->valid)) {
            $app = \Slim\Slim::getInstance();
            $app->render(400, array(
                'error' => true,
                'return' => $this->valid
            ));
            exit;
        }

        return $values;
    }

    public function debug($query, $params) {

        if(DEBUG) {
            global $logger;
            $logger->debug("==========================================================\n" .
                          "DEBUG QUERY:\n" .
                           print_r($query, true) . "\n" .
                           print_r($params, true) .
                          "============================================================================================\n"
                        );
        }
    }
}