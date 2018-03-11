CREATE DATABASE librason;

USE librason;

CREATE TABLE usuarios
(
	ID INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    DataNascimento DATE NOT NULL,
    Senha VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);

    
    