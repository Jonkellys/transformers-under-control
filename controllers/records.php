<?php

    class records extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function records($params) {

            $this->views->getView($this, "records");
        }

        
    }

?>
