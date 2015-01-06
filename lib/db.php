<?php
namespace DB;

require ROOT.APP.'configs'.DS.'database.php';

class DB {

    public $default;

    public function __construct($database=null, $read=false) {

        $db = new \DATABASE_CONFIG();

        if($database) {
            $this->default = $db->{$database};
        } else {
            $this->default = $db->use;
        }
    }
}