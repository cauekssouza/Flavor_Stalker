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
  nome_user VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  endereco_user VARCHAR(255) NOT NULL,
  foto_user MEDIUMBLOB,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_tipo) REFERENCES tipo_usuario(id_tipo)
);

CREATE TABLE restaurantes (
    id_restaurante INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    endereco VARCHAR(255),
    dono VARCHAR(255),
    estilo_culinario VARCHAR(255),
    descricao TEXT,
    horario VARCHAR(255),
    classificacao VARCHAR(255),
    capacidade INT,
    telefone VARCHAR(20)
);

CREATE TABLE avaliacao (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_restaurante INT,
    comentario TEXT,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante)
);

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

