
# Shoes

##### Epicodus Extended Database Code Review, 8/28/2015

#### By Ike Mattice

## Description

This program will list which shoe brands a shoe store carries.  The user can also look at an individual shoe brand to find out which stores carry that particular brand.

## Setup

Clone repository from GitHub.
Run $ composer install.
Run $ mysql.server start
Run $ mysql -uroot -proot
Run $ apachectl start
Import database hair_salon to mysql by logging on to localhost:8080/phpmyadmin and clicking the import button
Start php server in web directory.
Direct browser to localhost:8000/


## Technologies Used

PHP, phpunit, Silex, Twig, HTML, CSS, Bootstrap, Symfony, MySQL

## MySQL log

mysql> CREATE DATABASE shoes;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes;
Database changed

mysql> CREATE TABLE brands_table (id serial PRIMARY KEY, name VARCHAR (255))
    -> ;
Query OK, 0 rows affected (0.09 sec)

mysql> CREATE TABLE stores_table (id serial PRIMARY KEY, name VARCHAR (255))
    -> ;
Query OK, 0 rows affected (0.08 sec)

mysql> CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id INT, store_id INT);
Query OK, 0 rows affected (0.08 sec)

### Legal


Copyright (c) 2015 Ike Mattice

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
