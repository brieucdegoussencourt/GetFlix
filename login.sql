-- PostgreSQL SQL Dump

-- Table structure for table users

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL
);