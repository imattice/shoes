
<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

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
            Brand::deleteAll();
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

//test for find()
        function test_find()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = 'Rogans Shoes';
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $result = Store::find($test_store->getId());

            $this->assertEquals($test_store, $result);
        }

//test for update()
        function test_update()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);
            $test_store->save();

            $new_store_name = "Paymore Shoes";

            $test_store->update($new_store_name);
            $result = Store::getAll();
            $this->assertEquals("Paymore Shoes", $result[0]->getStoreName());
        }

//test for deleteOne()
        function test_deleteOne()
        {
            $store_name = 'Payless Shoes';
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = 'Rogans Shoes';
            $test_store2 = new Store($store_name2);
            $test_store2->save();


            $test_store->deleteOne();
            $this->assertEquals([$test_store2], Store::getAll());
        }
    }

?>
