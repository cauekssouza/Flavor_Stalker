SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP DATABASE IF EXISTS flavourstalkerdb;
CREATE DATABASE flavourstalkerdb;
USE flavourstalkerdb;

-- -----------------------------------------------------
-- Tipo de usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tipo_usuario (
  id_tipo INT NOT NULL AUTO_INCREMENT,
  nome_tipo VARCHAR(255) NULL DEFAULT NULL,
  descricao TEXT NULL DEFAULT NULL,
  PRIMARY KEY (id_tipo))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;

INSERT INTO `tipo_usuario` (`id_tipo`, `nome_tipo`, `descricao`) VALUES
(1, 'Comum', 'Pode dar feedback de restaurantes'),
(2, 'Dono de Restaurante', 'Pode gerenciar seu restaurante'),
(3, 'Administrador', 'Gerencia usuarios e restaurantes');

-- -----------------------------------------------------
-- Usuarios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id_user INT NOT NULL AUTO_INCREMENT,
  id_tipo INT NULL DEFAULT NULL,
  nome_user VARCHAR(255) NULL DEFAULT NULL,
  email VARCHAR(255) NULL DEFAULT NULL,
  senha VARCHAR(255) NULL DEFAULT NULL,
  endereco_user VARCHAR(255) NULL DEFAULT NULL,
  foto_user MEDIUMBLOB NULL DEFAULT NULL,
  data_criacao TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_user),
  UNIQUE INDEX email (email),
  INDEX id_tipo (id_tipo),
  CONSTRAINT usuarios_ibfk_1
    FOREIGN KEY (id_tipo)
    REFERENCES tipo_usuario (id_tipo))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;

INSERT INTO usuarios (id_tipo, nome_user, email, senha)
VALUES (3, 'Admin', 'Admin@123.com', '$2y$10$6COIqPqLnrKGXWkQ/U7AdeoFUd26p3.7B4udB8kWfxD9r/58M51R.');

-- -----------------------------------------------------
-- Status do restaurante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS status_restaurante (
  id_status INT NOT NULL,
  PRIMARY KEY (id_status))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Restaurantes
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS restaurantes (
  id_restaurante INT NOT NULL AUTO_INCREMENT,
  id_proprietario INT NULL DEFAULT NULL,
  nome VARCHAR(255) NULL DEFAULT NULL,
  endereco VARCHAR(255) NULL DEFAULT NULL,
  dono VARCHAR(255) NULL DEFAULT NULL,
  estilo_culinario VARCHAR(255) NULL DEFAULT NULL,
  descricao TEXT NULL DEFAULT NULL,
  horario VARCHAR(255) NULL DEFAULT NULL,
  capacidade INT NULL DEFAULT NULL,
  telefone VARCHAR(20) NULL DEFAULT NULL,
  foto_restaurante MEDIUMBLOB NULL DEFAULT NULL,
  status_restaurante_id_status INT NOT NULL,
  PRIMARY KEY (id_restaurante, status_restaurante_id_status),
  INDEX id_proprietario (id_proprietario),
  INDEX fk_restaurantes_status_restaurante1_idx (status_restaurante_id_status),
  CONSTRAINT restaurantes_ibfk_1
    FOREIGN KEY (id_proprietario)
    REFERENCES usuarios (id_user),
  CONSTRAINT fk_restaurantes_status_restaurante1
    FOREIGN KEY (status_restaurante_id_status)
    REFERENCES status_restaurante (id_status)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;

INSERT INTO restaurantes
(nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone, foto_restaurante, status_restaurante_id_status)
VALUES
('Cantina Italiana', 'Rua das Flores, 123, Bairro Jardim', 'José Almeida', 'Italiano', 'A Cantina Italiana oferece uma experiência autêntica de culinária italiana, com uma seleção de pratos tradicionais preparados com ingredientes importados.', '12:00 - 23:00', 50, '1234-5678', "gallery_2.jpeg", 1);

SELECT * FROM restaurantes;

-- -----------------------------------------------------
-- Prato
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS prato (
  id_prato INT NOT NULL AUTO_INCREMENT,
  id_restaurante INT NULL DEFAULT NULL,
  ingredientes VARCHAR(255) NULL DEFAULT NULL,
  preco DECIMAL(10,2) NULL DEFAULT NULL,
  nome VARCHAR(255) NULL DEFAULT NULL,
  modo_preparo VARCHAR(255) NULL DEFAULT NULL,
  info_nutricional VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (id_prato),
  INDEX id_restaurante (id_restaurante),
  CONSTRAINT prato_ibfk_1
    FOREIGN KEY (id_restaurante)
    REFERENCES restaurantes (id_restaurante))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Tabela de notas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS nota (
  id_nota INT NOT NULL,
  PRIMARY KEY (id_nota))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Avaliacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS avaliacao (
  id_avaliacao INT NOT NULL AUTO_INCREMENT,
  id_user INT NULL DEFAULT NULL,
  id_restaurante INT NULL DEFAULT NULL,
  id_prato INT NULL DEFAULT NULL,
  comentario TEXT NULL DEFAULT NULL,
  data_comentario TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  nota_id_nota INT NOT NULL,
  PRIMARY KEY (id_avaliacao),
  INDEX id_user (id_user),
  INDEX id_restaurante (id_restaurante),
  INDEX id_prato (id_prato),
  INDEX fk_avaliacao_nota1_idx (nota_id_nota),
  CONSTRAINT avaliacao_ibfk_1
    FOREIGN KEY (id_user)
    REFERENCES usuarios (id_user),
  CONSTRAINT avaliacao_ibfk_2
    FOREIGN KEY (id_restaurante)
    REFERENCES restaurantes (id_restaurante),
  CONSTRAINT avaliacao_ibfk_3
    FOREIGN KEY (id_prato)
    REFERENCES prato (id_prato),
  CONSTRAINT fk_avaliacao_nota1
    FOREIGN KEY (nota_id_nota)
    REFERENCES nota (id_nota)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Tipo do restaurante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tipo_restaurante (
  id_tipo INT NOT NULL,
  restaurantes_id_restaurante INT NOT NULL,
  PRIMARY KEY (id_tipo),
  INDEX fk_tipo_restaurante_restaurantes1_idx (restaurantes_id_restaurante),
  CONSTRAINT fk_tipo_restaurante_restaurantes1
    FOREIGN KEY (restaurantes_id_restaurante)
    REFERENCES restaurantes (id_restaurante)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
