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

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        //test for save()
                function test_save()
                {
                    $brand_name = 'Nike';
                    $test_brand = new Brand($brand_name);

                    $test_brand->save();
                    $result = Brand::getAll();

                    $this->assertEquals($test_brand, $result[0]);
                }

        //test for getAll()
                function test_getAll()
                {
                    $brand_name = 'Nike';
                    $test_brand = new Brand($brand_name);
                    $test_brand->save();

                    $brand_name2 = 'Adidas';
                    $test_brand2 = new Brand($brand_name2);
                    $test_brand2->save();

                    $result = Brand::getAll();

                    $this->assertEquals([$test_brand, $test_brand2], $result);
                }

        //test for deleteAll()
                function test_deleteAll()
                {
                    $brand_name = 'Nike';
                    $test_brand = new Brand($brand_name);
                    $test_brand->save();

                    $brand_name2 = 'Adidas';
                    $test_brand2 = new Brand($brand_name2);
                    $test_brand2->save();

                    Brand::deleteAll();
                    $result = Brand::getAll();

                    $this->assertEquals([], $result);
                }
    }
?>
