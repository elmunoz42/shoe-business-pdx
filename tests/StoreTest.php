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
    class StoreTest extends PHPUnit_Framework_TestCase{

        protected function teardown()
        {
            // Brand::deleteAll();
            Store::deleteAll();
        }

        function test_construct()
        {
            // Arrange
            $input_name = "Keens";
            $input_id = 1;
            $test_store = new Store("", $input_id);
            $test_store->setName($input_name);

            // Act
            $result1 = $test_store->getName();
            $result2 = $test_store->getId();

            // Assert
            $this->assertEquals($input_name, $result1);
            $this->assertEquals($input_id, $result2);

        }

        function test_save()
        {
            // Arrange
            $input_name = "Keens";
            $test_store = new Store($input_name);
            $test_store->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $input_name = "Keens";
            $test_store = new Store($input_name);
            $test_store->save();

            // Act
            Store::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([],$result);
        }

        function test_update()
        {
            // Arrange
            $input_name = "Keens";
            $input_name2 = "The Bruggliatos";
            $test_store = new Store($input_name);
            $test_store->save();

            // Act
            $test_store->update($input_name2);
            $result = Store::getAll();

            // Assert
            $this->assertEquals($input_name2, $result[0]->getName());
        }

        function test_find()
        {
            // Arrange
            $input_name = "Keens";
            $test_store = new Store($input_name);
            $test_store->setName($input_name);
            $test_store->save();
            $input_name2 = "The Bruggliatos";
            $test_store2 = new Store($input_name2);
            $test_store2->save();

            // Act
            $result = Store::find($test_store2->getId());

            // Assert
            $this->assertEquals($test_store2, $result);

        }

        function test_delete()
        {
            // Arrange
            $input_name = "Keens";
            $test_store = new Store($input_name);
            $test_store->setName($input_name);
            $test_store->save();
            $input_name2 = "The Bruggliatos";
            $test_store2 = new Store($input_name2);
            $test_store2->save();

            // Act
            $test_store->delete();
            $result = Store::getAll();

            // Assert
            $this->assertEquals($test_store2, $result[0]);
        }

        function test_findBrands()
        {
            
        }
    }

?>
