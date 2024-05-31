<?php

    class newRecord extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function newRecord($params) {

            $this->views->getView($this, "newRecord");
        }

        
    }

?>
