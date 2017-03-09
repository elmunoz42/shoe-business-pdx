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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->setName($new_name);
        }

        static function find($searchId)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$searchId};");
            $stores = array();
            $returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach( $returned_stores as $store )
            {
                $store_name = $store['name'];
                $store_id = $store['id'];
                $re_store = new Store($store_name, $store_id);
                array_push($stores, $re_store);
            }
            return $stores[0];
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        }

        function findBrands()
        {
            $query = $GLOBALS['DB']->query("SELECT brands.* FROM
            stores  JOIN brands_stores ON (stores.id = brands_stores.store_id)
                    JOIN brands ON (brands_stores.brand_id = brands.id)
                    WHERE stores.id = {$this->getId()};");

            $results = array();
            foreach( $query as $brand )
            {
                $brand_name = $brand['name'];
                $brand_id = $brand['id'];
                $re_brand = new Brand($brand_name, $brand_id);
                array_push($results, $re_brand);
            }
            return $results;
        }

        function assignBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id}, {$this->getId()});");
        }
    }

 ?>
