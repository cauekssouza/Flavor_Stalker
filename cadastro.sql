CREATE DATABASE cadastro;
USE cadastro;
CREATE TABLE cadastro (
    idcadastro INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(45),
    Email VARCHAR(110) UNIQUE,
    Senha VARCHAR(100),
    UNIQUE (Nome, Senha)
);
SELECT * FROM cadastro;


