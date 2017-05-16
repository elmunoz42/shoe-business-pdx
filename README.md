# _Shoe-Business-PDX_

#### _Shoe Business Guide for Portland Or._

#### By _**Carlos Muñoz Kampff**_

## Description

_App that allows user to register, view matches, and edit and delete shoe stores and brands._


## Specifications

| Behavior                                              |   Input example   |  Output example |
|-------------------------------------------------------|:-----------------:|:---------------:|
| 0) User goes to store page and sees that there are no registered stores.| click STORES link | "No stores registered yet."|
| 1) User can register a store.|"Next Adventure" submit the form in the STORES page| view created store.|
| 2) User can view a list of stores.|click on STORES link | list of registered stores|
| 3) User can view and individual store.|click on store link "Next Adventure"| "Next Adventure" page |
| 4) User can update a stores information.|in "Next Adventure" store page type "Great Adventure" submit | "Great Adventure" |
| 5) User can delete all stores.| delete all in stores page | "no stores registered yet"|
| 6) User can delete a single store.| in "Great Adventure" store page click delete | "store has been deleted." |
| 7) User can register a brand.| In brands page type "Vionic" click submit | view created brand. |
| 8) User can view list of brands.| In brands page | view created brands.|
| 9) User can view and individual brand.| click on "Vionic"| view brand in brand page. |
| 10) User can match a brand to a store.| in brand page assign store form "Great Foot Store"| "Great Foot Store"|
| 11) User can view all the brands assigned to a store.| in "Great Foot Store"| "Vionic"|
| 12) User can match a store to a brand.|in "Great Foot Store" store page input "Keens" in assign brand form| "Keens"|
| 13) User can view all the stores assigned to a brand.| click link to "Vionic" page| "Great Foot Store"|


## Setup/Installation Requirements
* _Production database: shoes_
* _Development database: shoes_test_
* _Apache port number in MAMP>settings: 8888_
* _MySQL port number in MAMP>settings: 8889_


### Database Tables Creation steps: (unnecessary if shoes.sql.zip and shoes_test.sql.zip are imported )
* _CREATE DATABASE shoes;_
* _CREATE TABLE brands (name VARCHAR(255), id serial PRIMARY KEY);_
* _CREATE TABLE stores (name VARCHAR(255), id serial PRIMARY KEY);_
* _CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY);_

### Installation:
* _unzip the shoes.sql.zip and shoes_test.sql.zip_
* _browse to http://localhost:8888/MAMP/index.php?page=phpmyadmin&language=English_
* _import the sql files above._
* _run MAMP and click start servers._
* _Clone repository from github._
* _In Terminal run: Install composer_
* _In the MAMP application set: preferences > web server > Shoe-Business-PDX > web ._
* _Open localhost:8888 in the browser of your choice. *** VIEW KNOWN BUGS BELLOW ***_


_web browser and PHP 5 are necessary to operate this _

## Known Bugs

_At this time the Apache server at localhost:8888 is not displaying the site on my local computer.
The instructions above work on certain versions of MAMP but apparently not mine.
As a temporary solution I'm using a php server in my document directory to run the site._
* _in the web folder run: php -S localhost:8000._
* _type localhost:8000 in the browser._

## Support and contact details

_No support._

## Technologies Used

* _PHP_
* _Silex_
* _MySQL_

### License

*MIT*

Copyright (c) 2017 **_Carlos Munoz Kampff_**
