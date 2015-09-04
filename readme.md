Shoe Store

This application allows the user to keep track of shoe brands and the store that sell these brands. 
The user can input either add shoe brands or stores that will sell shoes.  The user can enter shoe brands 
to an existing created store or enter a store to an associated store.

Technologies used:

PHPUnit, Silex, Twig, PHP/HTML, MySQL

Setup Instructions

-Clone Store_Shoes2 repository
-Run composer install in project folder
-Unzip shoes.sql and import to MySQL database
-Start PHP server in web folder
-Enter " localhost:8000 " into your web browser

MySQL commands 

- create database shoes; 
- use stores;
- create table brands (name varchar(255), id serial PRIMARY KEY);
- create table stores (name varchar(255), id serial PRIMARY KEY);
- create table stores_brands (brand_id int, store_id int, id serial);

Legal

Copyright (c) 2015 Adam Won

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.





