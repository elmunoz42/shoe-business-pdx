## Setup/Installation Requirements
* _CREATE DATABASE shoes;_

* _CREATE TABLE brands (name VARCHAR(255), id serial PRIMARY KEY);_

| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| name  | varchar(255)        | YES  |     | NULL    |                |
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

* _CREATE TABLE stores (name VARCHAR(255), id serial PRIMARY KEY);_

| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| name  | varchar(255)        | YES  |     | NULL    |                |
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |

* _CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY);_

| Field    | Type                | Null | Key | Default | Extra          |
|----------|---------------------|------|-----|---------|----------------|
| brand_id | int(11)             | YES  |     | NULL    |                |
| store_id | int(11)             | YES  |     | NULL    |                |
| id       | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
