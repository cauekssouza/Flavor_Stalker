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
  nome_tipo VARCHAR(255) NULL DEFAULT 1,
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
  id_status INT NOT NULL DEFAULT 2,
  nome_status varchar(10),
  PRIMARY KEY (id_status))
ENGINE = InnoDB;

INSERT INTO `status_restaurante` (`id_status`, `nome_status`) VALUES
(1, 'Aprovado'),
(2, 'Aguardando'),
(3, 'Recusado');

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
    status_restaurante_id_status INT NOT NULL DEFAULT 2,
    PRIMARY KEY (id_restaurante),
    INDEX id_proprietario (id_proprietario),
    INDEX fk_restaurantes_status_restaurante1_idx (status_restaurante_id_status),
    CONSTRAINT restaurantes_ibfk_1
        FOREIGN KEY (id_proprietario)
        REFERENCES usuarios (id_user),
    CONSTRAINT fk_restaurantes_status_restaurante1
        FOREIGN KEY (status_restaurante_id_status)
        REFERENCES status_restaurante (id_status)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
) ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


INSERT INTO restaurantes
(nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone, foto_restaurante, status_restaurante_id_status)
VALUES
('Cantina Italiana', 'Rua das Flores, 123, Bairro Jardim', 'José Almeida', 'Italiana', 'A Cantina Italiana oferece uma experiência autêntica de culinária italiana, com uma seleção de pratos tradicionais preparados com ingredientes importados.', '12:00 - 23:00', 50, '1234-5678', "gallery_6.jpeg", 1),
('Grill Master', 'Avenida Central, 456, Bairro Centro', 'Maria Oliveira', 'Brasileira', 'O Grill Master é o destino perfeito para os amantes de churrasco, oferecendo uma variedade de cortes de carne de alta qualidade preparados na brasa, além de acompanhamentos e sobremesas irresistíveis.', '11:00 - 22:00', 80, '9876-5432', "gallery_5.jpeg", 1);

SELECT * FROM restaurantes;

-- -----------------------------------------------------
-- Favoritos
-- -----------------------------------------------------

CREATE TABLE favoritos (
    id_user INT,
    id_restaurante INT,
    PRIMARY KEY(id_user, id_restaurante),
    FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante)
);

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
	CREATE TABLE nota (
		id_user INT NOT NULL,
		id_restaurante INT NOT NULL,
		id_nota INT NOT NULL,
		PRIMARY KEY (id_restaurante, id_user),
		FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
		FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante)
	);

-- -----------------------------------------------------
-- Avaliacao
-- -----------------------------------------------------
CREATE TABLE avaliacao (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_restaurante INT,
    comentario TEXT,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante)
);

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
