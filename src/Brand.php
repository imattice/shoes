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
    }
?>
