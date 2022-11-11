#My Library 

For setup configuration :

##Setup

After Create database you need to change configuration in "inc/PgSql.php".
```sql
 private $host = "localhost";
    private $port = "5432";
    private $dbname = "books";
    private $user = "postgres";
    private $password = "sql@123321";
```
And for Create tables you have all commands in sql_command.sql file

```sql

CREATE DATABASE books
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;
	
	
	
	CREATE TABLE IF NOT EXISTS authors (
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL
	);
	
	CREATE TABLE IF NOT EXISTS books (
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL,
    author_id int NOT NULL,
	CONSTRAINT fk_author
      FOREIGN KEY(author_id) 
	  REFERENCES authors(id) ON DELETE SET NULL
	);
```

Every think else in index.php file