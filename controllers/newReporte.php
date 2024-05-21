<?php

    class newReporte extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function newReporte($params) {

            $this->views->getView($this, "newReporte");
        }

        
    }

?>
