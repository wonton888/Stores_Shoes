<?php 
	class Store {
		private $name;
		private $id;

		function __construct($name, $id = null)
		{
			$this->name = $name;
			$this->id = $id;
		}

		function getName()
		{
			return $this->name;
		}

		function setName($new_name)
		{
			$this->name = $new_name;
		}

		function getId()
		{
			return $this->id;
		}

		function setId($new_id)
		{
			$this->id = $new_id;
		}

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES (
				'{$this->getName()}'
				);"
			);
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name);
		}

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM stores WHERE id {$this->getId()};");
			$GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE id = {$this->getId()};");
		}

		static function getAll()
		{
			$query = $GLOBALS['DB']->query("SELECT * FROM stores;");
			$all_stores = array();
			foreach ($query as $store){
				$name = $store['name'];
				$id = $store['id'];
				$new_store = new Store ($name, $id);
				array_push($all_stores, $new_store);
			}
			return $all_stores;
		}

		static function deleteAll()
		{
			$GLOBALS ['DB']->exec("DELETE FROM stores;");
			$GLOBALS['DB']->exec("DELETE FROM stores_brands;");
		}

		static function find($search_id)
		{
			$found_store = null;
			$returned_stores = Store::getAll();
			foreach ($returned_stores as $store){
				$store_id = $store->getId();
				if ($store_id == $search_id){
					$found_store = $store;
				}
			}
			return $found_store;
		}

		function addBrand($add_brand)
		{
			$GLOBALS['DB']->exec("INSERT INTO stores_brands (stores_id, brands_id) VALUES ({$this->getId()}, {$add_brand->getId()});");
		}

		function getBrands()
		{
			$query = $GLOBALS['DB']->query("SELECT brands.* FROM brands JOIN stores_brands ON (brands.id = stores_brands.brands_id) JOIN stores ON (stores_brands.stores_id = stores.id) WHERE stores.id = {$this->getId()};");
            $returned_query = $query->fetchAll(PDO::FETCH_ASSOC);
			$return_brands = array();

			foreach ($returned_query as $element)
			{
				$brand_name = $element['name'];
				$brand_id = $element['id'];
				$brand = new Brand($brand_name, $brand_id);
				array_push($return_brands, $brand);
			}
			return $return_brands;
		}

	}

?>
