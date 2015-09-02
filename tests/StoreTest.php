<?php 
	
	 /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */
	
	require_once "src/Store.php";
	require_once "src/Brand.php";
	
	$server = 'mysql:host=localhost;dbname=shoes_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);
	
	class StoreTest extends PHPUnit_Framework_TestCase
	{	
		protected function tearDown()
		{
			Store::deleteAll();
			// Brand::deleteAll();
		}
		
		//Getters and Setters
	
		function test_getName()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			
			//Act
			$result = $test_store->getName();
			
			//Assert
			$this->assertEquals($name, $result);	
			
		}
		
		function test_setName()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$new_name = "Store B";
			
			//Act
			$test_store->setName($new_name);
			$result = $test_store->getName();
			
			//Assert
			$this->assertEquals("Store B", $result);
			
		}
		
		function test_getId()
		{
			//Arrange
			$id = 1;
			$name = "Store A";
			$test_store = new Store ($name, $id);
			
			//Act
			$result = $test_store->getId();
			
			//Assert
			$this->assertEquals(1, $result);
		
		}
		
		function test_setId()
		{
			//Arrange
			$id = 1;
			$name = "Store A";
			$test_store = new Store ($name, $id);
			$new_id = 2;
			$test_store->setId($new_id);
			
			//Act
			$result = $test_store->getId();
			
			//Assert
			$this->assertEquals(2, $result);
			
		}
		
		function test_save()
		{
			$name = "Store A";
			$test_store = new Store($name);
			$test_store->save();
			
			//Act
			$result = Store::getAll();
			
			//Assert
			$this->assertEquals($test_store, $result[0]);

		}
		
		function getAll()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$test_store->save();
			
			$name2 = "Store B";
			$test_store2 = new Store ($name2);
			$test_store2->save();
			
			//Act
			$result = Store::getAll();
			
			//Assert
			$this->assertEquals([$test_store, $test_store2], $result);
		}
		
		function test_deleteAll()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store($name);
			$test_store->save();
			
			$name2 = "Store B";
			$test_store2 = new Store($name2);
			$test_store2->save();
			
			//Act
			Store::deleteAll();
			$result = Store::getAll();
			
			//Assert
			$this->assertEquals([], $result);
		}
		
		function test_updateDatabase()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store($name);
			$test_store->save();
			
			$new_name = "Store B";
			$test_store->update($new_name);
			
			//Act
			$result = Store::getAll();
			
			//Assert
			$this->assertEquals("Store B", $result[0]->getName());
		}
		
		function test_find()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$test_store->save();
			
			$name2 = "Store B";
			$test_store2 = new Store ($name2);
			$test_store2->save();
			
			//Act
			$search_id = $test_store2->getId();
			$result = Store::find($search_id);
			
			//Assert
			$this->assertEquals($test_store2, $result);
			
		}
		
		function test_delete()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$test_store->save();
			
			$name2 = "Store B";
			$test_store2 = new Store($name2);
			$test_store2->save();
			
			//Act
			$test_store->delete();
			$result = Store::getAll();
			
			//Assert
			$this->assertEquals([$test_store2], $result);	
			
		}
		
		function test_addBrand()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store($name);
			$test_store->save();
			
			$brand_name = "Shoe A";
			$test_brand = new Brand($brand_name);
			$test_brand->save();
			
			//Act
			$test_store->addBrand($test_brand);
			$result = $test_store->getBrands();
			
			//Assert
			$this->assertEquals([$test_brand], $result);
			
		}
		
		function test_getBrands()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$test_store->save();
			
			$brand_name = "Shoe A";
			$test_brand = new Brand($brand_name);
			$test_brand->save();
			
			$brand_name2 = "Shoe B";
			$test_brand2 = new Brand($brand_name2);
			$test_brand2->save();
			
			//Act
			$test_store->addBrand($test_brand);
			$test_store->addBrand($test_brand2);
			$result = $test_store->getBrands();
			
			//Assert
			$this->assertEquals([], $result);	
			
		}
		
		function test_deleteBrandJoinTable()
		{
			//Arrange
			$name = "Store A";
			$test_store = new Store ($name);
			$test_store->save();
			
			$brand_name = "Shoe A";
			$test_brand = new Brand($brand_name);
			$test_brand->save();
			
			//Act
			$test_store->addBrand($test_brand);
			$test_brand->delete();
			$result = $test_store->getBrands();
			
			//Assert
			$this->assertEquals([], $result);
			
		}
		
		
		
		
	}	
?>
	
