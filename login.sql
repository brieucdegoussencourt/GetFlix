-- PostgreSQL SQL Dump

-- Database: login

-- Table structure for table contact

CREATE TABLE contact (
  id SERIAL PRIMARY KEY,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  subject varchar(255) NOT NULL,
  message varchar(255) NOT NULL
);

-- Dumping data for table contact

INSERT INTO contact (id, name, email, subject, message) VALUES
(1, 'Ajay', 'ajay@gmail.com', 'qdeeas', 'dsgffhgjhmhjm');

-- Table structure for table users

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);

-- Dumping data for table users

INSERT INTO users (id, username, password) VALUES
(1, 'John Doe', 'password123'),
(2, 'Jane Doe', 'password456'),
(3, 'Alice', 'password789'),
(4, 'Bob', 'password101112'),
(5, 'Keerti Panwar', 'keerti1234@gmail.com', '$2y$10$PL6oQH71xCh3F3BALBuVYu6SLn2AVQ41o.i5vi2LosRIWEh1H.0Zi');

-- Indexes for dumped tables

-- Indexes for table contact
-- (Primary key already defined in table creation)

-- Indexes for table users
-- (Primary key already defined in table creation)

-- AUTO_INCREMENT for dumped tables
-- (Handled by SERIAL type in PostgreSQL)