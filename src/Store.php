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

//retrieves all saved stores
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores_table;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['name'];
                $id = $store['id'];
                $new_store = new Store ($store, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

    }
?>
