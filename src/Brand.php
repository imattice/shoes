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

//deletes all saved brands
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_table;");
        }

    }
?>
