<?php

    class locations extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function locations($params) {

            $this->views->getView($this, "locations");
        }

        
    }

?>
