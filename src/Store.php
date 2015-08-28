<?php
    class Store
    {
        private $id;
        private $store_name;

//Store object constructor
        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

//setters
        function setStoreName($new_store_name)
        {
            $this->store_name = (string) $new_store_name;
        }

//getters
        function getStoreName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

//saves an instance of Store to the database
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_table (name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

//updates the name of a saved store
        function update ($new_store_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores_table SET name = '{$new_store_name}' WHERE id = {$this->getId()};");
        }

//deletes a single instance of Store
        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_table WHERE id = {$this->getId()};");
        }

//adds a Brand to a specific Store
    function addBrand($brand)
   {
       $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
   }

//retrieves all Brands assodicated with a speficif store
   function getBrand()
   {

       $returned_brands = $GLOBALS['DB']->query("SELECT brands_table.* FROM stores_table
           JOIN brands_stores ON (stores_table.id = brands_stores.store_id)
           JOIN brands_table ON (brands_stores.brand_id = brands_table.id)
           WHERE stores_table.id = {$this->getId()};");

       $brands = array();
       foreach ($returned_brands as $brand) {
           $brand_name = $brand['name'];
           $id = $brand['id'];
           $new_brand = new Brand($brand_name, $id);
           array_push($brands, $new_brand);
       }
       return $brands;
   }

//retrieves all saved stores
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores_table;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['name'];
                $id = $store['id'];
                $new_store = new Store ($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

//deletes all saved stores
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_table;");
        }


//function for finding a specific store
        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $id = $store->getId();
                if ($id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }



    }
?>
