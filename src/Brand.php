<?php

    class Brand
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
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->name}');");
            $this->id = (int) $GLOBALS['DB']->LastInsertId();
        }

        static function getAll()
        {
            $brands = array();
            $query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            foreach( $query as $brand)
            {
                $brand_name = $brand['name'];
                $brand_id = $brand['id'];
                $re_brand = new Brand($brand_name, $brand_id);
                array_push($brands, $re_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->setName($new_name);
        }

        static function find($searchId)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$searchId};");
            $brands = array();
            $returned_brands = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach( $returned_brands as $brand )
            {
                $brand_name = $brand['name'];
                $brand_id = $brand['id'];
                $re_brand = new Brand($brand_name, $brand_id);
                array_push($brands, $re_brand);
            }
            return $brands[0];
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }

        function assignStore($store_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store_id});");
        }

        function findStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
            brands  JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                    JOIN stores ON (brands_stores.store_id = stores.id)
                    WHERE brands.id = {$this->getId()};");

            $results = array();
            foreach( $query as $store )
            {
                $store_name = $store['name'];
                $store_id = $store['id'];
                $re_store = new Store($store_name, $store_id);
                array_push($results, $re_store);
            }
            return $results;
        }
    }

 ?>
