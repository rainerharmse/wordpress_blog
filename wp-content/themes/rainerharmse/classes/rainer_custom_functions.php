<?php
    class rainer_custom_functions{

        private $name;

        public function __construct($name){
            $this->name = $name;
        }

       public  function say_hello(){
            echo 'Hello ' . $this->name;
        }

}

