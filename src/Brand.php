<?php
    class Brand
    {
        private $id;
        private $brand_name;


//Brand object constructor
        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }


//setters
        function setBrandName($new_brand_name)
        {
            $this->brand_name = (string) $new_brand_name;
        }


//getters
        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }


//saves an instance of Brand to the database
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_table (name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }


//retrieves all saved brands
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands_table;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand ($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }


//function for finding a specific brand
        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $id = $brand->getId();
                if ($id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }


//deletes all saved brands
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_table;");
        }


//links a specific instance of Brand to a specific instance of Store
        function addStore($store)
        {
            //goes into the join table and adds the id of the current instance of brand next to the store that is called into the function
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }


//retrieves all stores associated with a specific instance of brand
        function getStore()
        {
            //join statement which starts at brands_table and links each table by id's, one table at a time, resulting in a list of stores that are associated with this brand.  Needs a foreach loop to pull out the individual stores and recreate them into Store objects.
            $returned_stores = $GLOBALS['DB']->query("SELECT stores_table.* FROM brands_table
                JOIN brands_stores ON (brands_table.id = brands_stores.brand_id)
                JOIN stores_table ON (brands_stores.store_id = stores_table.id)
                WHERE brands_table.id = {$this->getId()};");

            //creates empty array to insert the linked store information
            $stores = array();

            //goes through the associated array created by the join statement and builds a new store object from that information
            foreach ($returned_stores as $store) {
                $store_name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);

                //pushes the newly created store objects to the empty array
                array_push($stores, $new_store);
            }

            //returns the newly filled array with the resulting store objects
            return $stores;
        }


    }
?>
