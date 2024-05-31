<?php

    class configurations extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function configurations($params) {
            $this->views->getView($this, "configurations");
        }

    }

?>
