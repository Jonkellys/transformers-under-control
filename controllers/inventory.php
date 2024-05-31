<?php

    class inventory extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function inventory($params) {

            $this->views->getView($this, "inventory");
        }

    }

?>
