<?php 
	    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";
    require_once "src/Store.php";

  $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function TearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

		function test_getId()
		{
			//Arrange
            $name = "Shoe A";
            $id = 1;
            $test_brand = new Brand ($name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(1, $result);

		}


        function test_setId()
   	    {
			//Arrange
			$id = 1;
			$name = "Shoe A";
			$test_brand = new Store ($name, $id);
			$new_id = 2;
			$test_brand->setId($new_id);

			//Act
			$result = $test_brand->getId();

			//Assert
			$this->assertEquals(2, $result);

		}

		function test_getBrand()
        {

            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);

            //Act
            $result = $test_brand->getBrand();

            //Assert
            $this->assertEquals("Shoe A", $result);
        }

        function test_setBrand()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $new_name = "Shoe B";

            //Act
            $test_brand->setBrand($new_name);
            $result = $test_brand->getBrand();

            //Assert
            $this->assertEquals("Shoe B", $result);


        }

        function test_save()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Shoe C";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Shoe C";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $this->assertEquals([], Brand:: getAll());

        }

        function test_find()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Shoe C";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            //Act
            $search_id = $test_brand2->getId();
            $result = Brand::find($search_id);

            //Assert
            $this->assertEquals($test_brand2, $result);


        }

        function test_addStore()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "Store C";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store], $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = "Shoe A";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "Store C";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Store D";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store,$test_store2], $result);

        }
    }






?>
