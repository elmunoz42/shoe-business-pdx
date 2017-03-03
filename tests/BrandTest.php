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

        // protected function teardown()
        // {
        //     Brand::deleteAll();
        //     Store::deleteAll();
        // }

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
    }

?>
