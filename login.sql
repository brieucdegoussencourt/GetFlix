-- PostgreSQL SQL Dump

-- Table structure for table users

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);

-- Dumping data for table users

INSERT INTO users (id, username, password) VALUES
(1, 'user', 'pass$2y$10$scGJ2BYOgSswoxV1puekkO2IXoz7pHA2DL2X9ToRM.Ege9yomym5m');