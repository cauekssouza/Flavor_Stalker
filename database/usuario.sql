CREATE TABLE usuarios (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  nome_user VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  endereco_user VARCHAR(255) NOT NULL,
  foto_user VARCHAR(255) DEFAULT 'default_icon.png'
);


INSERT INTO usuarios (nome_user, email, senha, endereco_user) VALUES
("pedro", "pedro@gmail", "123", "rua 1"),
("rafael", "rafael@gmail", "456", "rua 2");