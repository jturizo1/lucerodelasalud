create database dblucerosds;
use dblucerosds;

create table users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    passwordkey VARCHAR(255) NOT NULL,
    numberid INT(20) NOT NULL UNIQUE,
    nameuser VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    nationality VARCHAR(50) NOT NULL,
    age INT(20) NOT NULL,
    birthdate DATE DEFAULT NOT NULL,
    creationdate DATE DEFAULT (CURRENT_DATE),
    updatedate DATE DEFAULT
    stateact INT
);

insert into users (username, passwordkey, numberid, nameuser, lastname, nationality, age, birthdate, stateact) VALUES ('camiloasic@gmail.com', MD5('+alejandro1004-'), '93422772','Camilo','Cardozo','Colombiano','39','10/04/1985','1');

create table cert_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
);
