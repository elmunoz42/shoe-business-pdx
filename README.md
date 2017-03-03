# _Shoe-Business-PDX_

#### _Shoe Business Guide for Portland Or._

#### By _**Carlos Munoz Kampff**_

## Description

_App that allows ._


## Specifications

| Behavior                                              |   Input example   |  Output example |
|-------------------------------------------------------|:-----------------:|:---------------:|
| 1) User can register a store.|||
| 2) User can view list of stores.|||
| 3) User can view and individual store.|||
| 4) User can update a stores information|||
| 5) User can delete all stores.|||
| 6) User can delete a single store|||
| 7) User can register a brand.|||
| 8) User can view list of brands.|||
| 9) User can view and individual brand.|||
| 10) User can update a brands information|||
| 11) User can delete all brands.|||
| 12) User can delete a single brand|||


## Setup/Installation Requirements
    Production database: shoes
    Development database: shoes_test
    Apache port number in MAMP>settings: 8888
    MySQL port number in MAMP>settings: 8889


* _CREATE DATABASE shoes;_
* _CREATE TABLE brands (name VARCHAR(255), id serial PRIMARY KEY);_
* _CREATE TABLE stores (name VARCHAR(255), id serial PRIMARY KEY);_
* _CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY);_
### Database Tables Creation steps:


### Installation:
* _unzip the shoes.sql.zip and shoes_test.sql.zip_
* _run MAMP and click start servers._
* _Clone repository from github._
* _In Terminal run: Install composer_
* _In the MAMP application set: preferences > web server > Shoe-Business-PDX > web ._
* _Open localhost:8888 in the browser of your choice._


_web browser and PHP 5 are necessary to operate this _

## Known Bugs

_There are no known present at this time._

## Support and contact details

_No support._

## Technologies Used

* _PHP_
* _Silex_
* _MySQL_

### License

*MIT*

Copyright (c) 2017 **_Carlos Munoz Kampff_**
