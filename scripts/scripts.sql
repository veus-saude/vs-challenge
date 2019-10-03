CREATE DATABASE vs_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE produtos (
    id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100) NOT NULL,
    marca varchar(100) NOT NULL,
    preco decimal(11,2) NOT NULL,
    quantidade int(10)  NOT NULL,
    updated_at timestamp,
    created_at timestamp
);

CREATE TABLE usuarios (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100) NOT NULL,
    email varchar(150) NOT NULL,
    senha varchar(32) NOT NULL 
);

INSERT INTO produtos (nome, marca, preco, quantidade)
VALUES ("seringa","BUNZL",0.30,2000);

INSERT INTO usuarios (nome, email, senha)
VALUES ("Renan Queiroz", "renanq@gmail.com", MD5("240625"));