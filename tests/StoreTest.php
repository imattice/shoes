
<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    //require_once "src/Brand.php";

// server signin
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            //Brand::deleteAll();
        }

//test for save()
        function test_save()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);

            $test_store->save();
            $result = Store::getAll();

            $this->assertEquals($test_store, $result[0]);
        }

//test for getAll()
        function test_getAll()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = 'Rogans Shoes';
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $result = Store::getAll();
            var_dump($result);
            $this->assertEquals([$test_store, $test_store2], $result);
        }

//test for deleteAll()
        function test_deleteAll()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = 'Rogans Shoes';
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([], $result);
        }
    }

?>
