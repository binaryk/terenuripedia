<?php
    namespace Binaryk\Formaker;


    class Form{
        protected $fields = NULL;
        public function __construct()
        {
          $this->field = [];
        }

        public function get()
        {
            return "Get fields";
        }
    }