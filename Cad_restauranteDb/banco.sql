CREATE DATABASE cad_restaurante;
USE cad_restaurante;

CREATE TABLE restaurantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    dono VARCHAR(255),
    telefone VARCHAR(15) NOT NULL,
    estilo_culinario VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    horario TIME NOT NULL,
    capacidade INT NOT NULL
);


SELECT * FROM restaurantes;