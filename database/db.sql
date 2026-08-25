create database if not exists petshop_db;
use petshop_db;

CREATE TABLE clientes ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL 
); 
CREATE TABLE animais ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(100) NOT NULL, 
    especie VARCHAR(50) NOT NULL, 
    raca VARCHAR(100) NOT NULL, 
    idade INT NOT NULL, 
    cliente_id INT NOT NULL, 
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) 
);