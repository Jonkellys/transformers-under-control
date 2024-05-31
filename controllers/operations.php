<?php

    class operations extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function operations($params) {

            $this->views->getView($this, "operations");
        }

        
    }

?>
