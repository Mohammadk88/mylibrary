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