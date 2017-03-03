<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class BrandTest extends PHPUnit_Framework_TestCase{

        protected function teardown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_construct()
        {
            // Arrange
            $input_name = "Keens";
            $input_id = 1;
            $test_brand = new Brand("", $input_id);
            $test_brand->setName($input_name);

            // Act
            $result1 = $test_brand->getName();
            $result2 = $test_brand->getId();

            // Assert
            $this->assertEquals($input_name, $result1);
            $this->assertEquals($input_id, $result2);

        }

        function test_save()
        {
            // Arrange
            $input_name = "Keens";
            $test_brand = new Brand($input_name);
            $test_brand->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $input_name = "Keens";
            $test_brand = new Brand($input_name);
            $test_brand->save();

            // Act
            Brand::deleteAll();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([],$result);
        }

        function test_update()
        {
            // Arrange
            $input_name = "Keens";
            $input_name2 = "The Bruggliatos";
            $test_brand = new Brand($input_name);
            $test_brand->save();

            // Act
            $test_brand->update($input_name2);
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($input_name2, $result[0]->getName());
        }

        function test_find()
        {
            // Arrange
            $input_name = "Keens";
            $test_brand = new Brand($input_name);
            $test_brand->save();
            $input_name2 = "The Bruggliatos";
            $test_brand2 = new Brand($input_name2);
            $test_brand2->save();

            // Act
            $result = Brand::find($test_brand2->getId());

            // Assert
            $this->assertEquals($test_brand2, $result);

        }

        function test_delete()
        {
            // Arrange
            $input_name = "Keens";
            $test_brand = new Brand($input_name);
            $test_brand->save();
            $input_name2 = "The Bruggliatos";
            $test_brand2 = new Brand($input_name2);
            $test_brand2->save();

            // Act
            $test_brand->delete();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($test_brand2, $result[0]);
        }

        function test_assignStore()
        {
            // Arrange
            $input_name = "The Bruggliatos";
            $test_store = new Store($input_name);
            $test_store->save();

            $input_brand_name = "Keens";
            $test_brand = new Brand($input_brand_name);
            $test_brand->save();

            $input_brand_name2 = "Nike";
            $test_brand2 = new Brand($input_brand_name2);
            $test_brand2->save();
            $test_brand2->assignStore($test_store->getId());

            // Act
            $result = $test_store->findBrands();

            // Assert
            $this->assertEquals([$test_brand2], $result);

        }

        function test_findStores()
        {
            // Arrange
            $input_brand_name = "Nike";
            $test_brand = new Brand($input_brand_name2);
            $test_brand->save();

            $input_name = "The Bruggliatos";
            $test_store = new Store($input_name);
            $test_store->save();
            $test_store->assignBrand($test_brand->getId());

            $input_store_name = "Next Adventure";
            $test_store2 = new Store($input_brand_name);
            $test_store2->save();
            $test_store2->assignBrand($test_brand->getId());


            // Act
            $result = $test_brand->findStores();

            // Assert
            $this->assertEquals([$test_store, $test_store2], $result);

        }
    }

?>
