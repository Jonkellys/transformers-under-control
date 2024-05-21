<?php

    class ubicacion extends controllers {
        public function __construct() {
            parent::__construct();
        }

        public function ubicacion($params) {

            $this->views->getView($this, "ubicacion");
        }


    }

?>
