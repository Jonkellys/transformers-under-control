<?php

    class transformer extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function transformer($params) {
            $this->views->getView($this, "transformer");
        }

    }

?>
