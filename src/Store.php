<?php

    class Store
    {
        private $name;
        private $id;

        function __construct($name, $id = null )
        {
            $this->name = (string) $name;
            $this->id = (int) $id;
        }

        // getters and setters
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        // Crud function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->name}');");
            $this->id = (int) $GLOBALS['DB']->LastInsertId();
        }

        static function getAll()
        {
            $stores = array();
            $query = $GLOBALS['DB']->query("SELECT * FROM stores;");
            foreach( $query as $store)
            {
                $store_name = $store['name'];
                $store_id = $store['id'];
                $re_store = new Store($store_name, $store_id);
                array_push($stores, $re_store);
            }
            return $stores;
        }
    }

 ?>
