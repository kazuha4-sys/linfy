-- Criação do database
CREATE DATABASE IF NOT EXISTS linfy;

-- Seleção do database
USE linfy;

-- Criação da tabela de usuarios (user)
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela de cursos (curso)
CREATE TABLE IF NOT EXISTS curso (
    id INT AUTO_INCREMENT PRIMARY KEY,                   -- ID do curso (chave primária)
    nome VARCHAR(100) NOT NULL UNIQUE,                   -- Nome do produto
    preco DECIMAL(10, 2) NOT NULL,                       -- Preço com 2 casas decimais (ex: 9999999999,99)
    mini_descricao TEXT,                                 -- Descrição curta, cabe no cardzinho
    categoria VARCHAR(50),                               -- Ex: 'Cursos', 'Hardware', 'Hacking'
    image VARCHAR(255),                                  -- URl da imagem ou nome do arquivo
    link VARCHAR(255), COMMENT                           -- Link do produto (máx recomendado)
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP    -- Pra saber quando foi adicionado 
);

-- Adiconar um usuario exempo (opcional)
-- INSERT INTO user(username, password) VALUES ('userame@gmail.com', 'SENHA_CRIPTOGRAFADA'); 
INSERT INTO user (username, email, password) VALUES ('admin', 'admin@gmail.com', 'admin');