DROP DATABASE IF EXISTS flavourstalkerdb;
CREATE DATABASE flavourstalkerdb;
USE flavourstalkerdb;

CREATE TABLE tipo_usuario (
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    nome_tipo VARCHAR(255),
    descricao TEXT
);

INSERT INTO `tipo_usuario` (`id_tipo`, `nome_tipo`, `descricao`) VALUES
(1, 'Comum', 'Pode dar feedback de restaurantes'),
(2, 'Dono de Restaurante', 'Pode gerenciar seu restaurante'),
(3, 'Administrador', 'Gerencia usuarios e restaurantes');

CREATE TABLE usuarios (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  id_tipo INT,
  nome_user VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  senha VARCHAR(255),
  endereco_user VARCHAR(255),
  foto_user MEDIUMBLOB,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_tipo) REFERENCES tipo_usuario(id_tipo)
);

INSERT INTO usuarios (id_tipo, nome_user, email, senha)
VALUES (3, 'Admin', 'Admin@123.com', '$2y$10$6COIqPqLnrKGXWkQ/U7AdeoFUd26p3.7B4udB8kWfxD9r/58M51R.');

CREATE TABLE restaurantes (
    id_restaurante INT AUTO_INCREMENT PRIMARY KEY,
    id_proprietario INT,
    nome VARCHAR(255),
    endereco VARCHAR(255),
    dono VARCHAR(255),
    estilo_culinario VARCHAR(255),
    descricao TEXT,
    horario VARCHAR(255),
    capacidade INT,
    telefone VARCHAR(20),
    foto_restaurante MEDIUMBLOB,
    FOREIGN KEY (id_proprietario) REFERENCES usuarios(id_user)
);

INSERT INTO restaurantes
(nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone, foto_restaurante)
VALUES
('Cantina Italiana', 'Rua das Flores, 123, Bairro Jardim', 'José Almeida', 'Italiano', 'A Cantina Italiana oferece uma experiência autêntica de culinária italiana, com uma seleção de pratos tradicionais preparados com ingredientes importados.', '12:00 - 23:00', 50, '1234-5678', "gallery_2.jpeg");

SELECT * FROM restaurantes;


CREATE TABLE prato (
    id_prato INT AUTO_INCREMENT PRIMARY KEY,
    id_restaurante INT,
    ingredientes VARCHAR(255),
    preco DECIMAL(10,2),
    nome VARCHAR(255),
    modo_preparo VARCHAR(255),
    info_nutricional VARCHAR(255),
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante)
);

CREATE TABLE avaliacao (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_restaurante INT,
    id_prato INT,
    comentario TEXT,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante),
    FOREIGN KEY (id_prato) REFERENCES prato(id_prato)
);