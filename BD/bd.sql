DROP DATABASE IF EXISTS BD_Blog;

CREATE DATABASE IF NOT EXISTS BD_Blog;
-- CHARACTER SET utf8mb4;
USE BD_Blog;

CREATE TABLE IF NOT EXISTS Rols(
  Id INT AUTO_INCREMENT,
  Name varchar(250) UNIQUE,
  PRIMARY KEY(Id)
  );

INSERT INTO Rols (Name) VALUES
('Admin'),
('Editor'),
('User')


CREATE TABLE IF NOT EXISTS Users (
  Id INT AUTO_INCREMENT,
  Email VARCHAR(250) UNIQUE,
  Name VARCHAR(250) UNIQUE,
  Password VARCHAR(250),
  Status INT DEFAULT(1),
  Role_id INT DEFAULT(3),
  Creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (Id),
  FOREIGN KEY (Role_id) REFERENCES Rols(Id)
);

CREATE TABLE IF NOT EXISTS Categories(
  Id INT AUTO_INCREMENT,
  Name VARCHAR(50),
  Slug VARCHAR(50),
  PRIMARY KEY (Id)
);

CREATE TABLE IF NOT EXISTS Posts (
  Id INT AUTO_INCREMENT,
  Name VARCHAR(100),
  Slug VARCHAR(100),
  Creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  Publish_at DATETIME,
  Author_id INT,
  Category_id INT,
  Content TEXT,
  Image VARCHAR(250),
  PRIMARY KEY (Id),
  FOREIGN KEY (Author_id) REFERENCES Users(Id),
  FOREIGN KEY (Category_id) REFERENCES Categories(id)
);

-- Demo Data
INSERT INTO Users (Email, Name, Password, Role_id) VALUES (
  'martinlopezpablo@gmail.com', 'pablo', '123', 1
);
INSERT INTO categories(Name, Slug) VALUES(
  'Category 1', 'Category-1'
)