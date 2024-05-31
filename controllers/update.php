<?php

    class update extends controllers {
        public function __construct() {
            parent::__construct();
        }
        
        public function update($params) {

            $this->views->getView($this, "update");
        }

        
    }

?>
