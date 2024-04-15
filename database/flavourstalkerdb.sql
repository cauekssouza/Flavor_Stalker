CREATE TABLE usuario (
    id_user INT PRIMARY KEY,
    nome_user VARCHAR,
    email VARCHAR,
    senha VARCHAR(255),
    endereco_user VARCHAR,
    foto_user BLOB,
    fk_tipousuario_id_tipo INT
);

CREATE TABLE avaliacao (
    notas INT,
    descricao TEXT,
    fk_usuario_id_user INT,
    fk_prato_id_prato INT,
    fk_restaurante_id_restaurante INT
);

CREATE TABLE prato (
    id_prato INT PRIMARY KEY,
    ingredientes VARCHAR,
    preco DECIMAL(10,2),
    nome VARCHAR,
    modo_preparo VARCHAR,
    info_nutricional VARCHAR,
    fk_restaurante_id_restaurante INT
);

CREATE TABLE restaurante (
    id_restaurante INT PRIMARY KEY,
    nome VARCHAR,
    localizacao VARCHAR,
    dono VARCHAR,
    estilo_culinario VARCHAR,
    descricao TEXT,
    horario VARCHAR,
    classificacao VARCHAR,
    capacidade INT
);

CREATE TABLE tipousuario (
    id_tipo INT PRIMARY KEY,
    nome_tipo VARCHAR,
    descricao TEXT
);

ALTER TABLE usuario ADD CONSTRAINT FK_usuario_2
    FOREIGN KEY (fk_tipousuario_id_tipo)
    REFERENCES tipousuario (id_tipo)
    ON DELETE RESTRICT;

ALTER TABLE avaliacao ADD CONSTRAINT FK_avaliacao_1
    FOREIGN KEY (fk_usuario_id_user)
    REFERENCES usuario (id_user)
    ON DELETE CASCADE;

ALTER TABLE avaliacao ADD CONSTRAINT FK_avaliacao_2
    FOREIGN KEY (fk_prato_id_prato)
    REFERENCES prato (id_prato)
    ON DELETE CASCADE;

ALTER TABLE avaliacao ADD CONSTRAINT FK_avaliacao_3
    FOREIGN KEY (fk_restaurante_id_restaurante)
    REFERENCES restaurante (id_restaurante)
    ON DELETE CASCADE;

ALTER TABLE prato ADD CONSTRAINT FK_prato_2
    FOREIGN KEY (fk_restaurante_id_restaurante)
    REFERENCES restaurante (id_restaurante)
    ON DELETE RESTRICT;