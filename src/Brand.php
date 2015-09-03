<?php

	class Brand {

		private $brand_name;
		private $id;

		function __construct($brand_name, $id = null)
		{
			$this->brand_name = $brand_name;
			$this->id = $id;
		}

		function getId()
		{
			return $this->id;
		}

		function setId($new_id)
		{
			 $this->id = $new_id;
		}

		function getBrand()
		{
			return $this->brand_name;
		}

		function setBrand($new_brand_name)
		{
			$this->brand_name = $new_brand_name;
		}

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES (
				'{$this->getBrand()}'
				);"
			);
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE id = {$this->getId()};");

		}

		function addStore($new_store)
		{
			$GLOBALS['DB']->exec("INSERT INTO stores_brands (stores_id, brands_id) VALUES ({$new_store->getId()}, {$this->getId()});");
		}

		function getStores()
		{
			$query = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (brands.id = stores_brands.brand_id) JOIN stores ON (stores_brands.store_id = stores.id) WHERE brands.id = {$this->getId()};");
			$return_stores = array();
			foreach ($query as $element){
				$name = $element['name'];
				$id = $element['id'];
				$new_store = new Store($name, $id);
				array_push($return_stores, $new_store);
			}
			return $return_stores;
		}

		static function getAll()
		{
			$query = $GLOBALS['DB']->query("SELECT * FROM brands;");
			$all_brands = array();
			foreach ($query as $brand){
				$name = $brand['name'];
				$id = $brand['id'];
				$new_brand = new Brand ($name, $id);
				array_push($all_brands, $new_brand);
			}
			return $all_brands;
		}

		static function deleteAll()
		{
			$GLOBALS ['DB']->exec("DELETE FROM brands;");
			$GLOBALS['DB']->exec("DELETE FROM stores_brands;");
		}

		static function find($search_id)
		{
			$found_brand = null;
			$returned_brands = Brand::getAll();
			foreach ($returned_brands as $brand){
				$brand_id = $brand->getId();
				if ($brand_id == $search_id){
					$found_brand = $brand;
				}
			}
			return $found_brand;

		}
	}


?>
