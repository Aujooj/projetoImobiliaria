CREATE DATABASE Estelar;
-- ---------------------------------------------------------------------------------------------------------
-- Criação das tabelas

CREATE TABLE corretores (
  id_corretor INT AUTO_INCREMENT PRIMARY KEY,
  creci VARCHAR(8) NOT NULL,
  senha VARCHAR(60) NOT NULL,
  data_nasc DATE NOT NULL,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL
);

CREATE TABLE clientes(
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  cpf VARCHAR(14) NOT NULL,
  data_nasc DATE NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL,
  cep INTEGER NOT NULL,
  rua VARCHAR(100),
  bairro VARCHAR (50),
  numero INTEGER,
  cidade VARCHAR(50),
  estado VARCHAR(2)
);

CREATE TABLE imoveis (
  id_produto INTEGER AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('Apartamento', 'Casa Residencial', 'Chácara', 'Comercial', 'Condomínio', 'Terreno'),
  cep INTEGER NOT NULL,
  rua VARCHAR(100),
  bairro VARCHAR (50),
  numero INTEGER,
  cidade VARCHAR(50),
  estado VARCHAR(2),
  valor DOUBLE(11, 2),
  condominio BOOLEAN,
  area_total INT,
  dormitorios INT,
  banheiros INT,
  garagem INT,
  id_contrato INT NOT NULL FOREIGN KEY REFERENCES contratos(id_contrato),
  proprietario INT NOT NULL FOREIGN KEY REFERENCES clientes(id_cliente)
);

CREATE TABLE contratos (
  id_contrato INTEGER AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('Locação', 'Venda'),
  data_inicial DATETIME,
  data_final DATETIME,
  inquilino INT NOT NULL FOREIGN KEY REFERENCES clientes(id_cliente),
  id_imovel INT NOT NULL FOREIGN KEY REFERENCES imovel(id_imovel)
);

-- ---------------------------------------------------------------------------------------------------------
-- Inserção de dados

INSERT INTO corretores (creci, senha, data_nasc, nome, telefone, email) 
VALUES 
('12345678', '$2y$13$7OLpVlvrM.TZyZ7ccnu3N.03ZE2teOeC/QKDKlpTu6UDPddCMmxTW', '2002-03-20', 'João Augusto de Souza Santos', '1228611876', 'jsantos.2021@alunos.utfpr.edu.br'), 
('87654321', '$2y$13$wtz3m3cNlDLNOyNQgylM0uSTw1TkE7PNZPAOfqOEz2tKoyij1Tj6O', '1996-11-17', 'Wagner Cordeiro Gomes da Silva', '42980224425', 'wagnercordeiro@alunos.utfpr.edu.br');
