CREATE DATABASE Estelar;
Use Estelar;
-- ---------------------------------------------------------------------------------------------------------
-- Criação das tabelas

CREATE TABLE corretores (
  id_corretor INT AUTO_INCREMENT PRIMARY KEY,
  creci VARCHAR(5) NOT NULL,
  senha VARCHAR(60) NOT NULL,
  data_nasc DATE NOT NULL,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL
);

CREATE TABLE clientes (
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
  id_imovel INTEGER AUTO_INCREMENT PRIMARY KEY,
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
  proprietario INT NOT NULL,
  FOREIGN KEY (proprietario) REFERENCES clientes(id_cliente)
);

CREATE TABLE contratos (
  id_contrato INTEGER AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('Locação', 'Venda'),
  data_inicial DATETIME,
  data_final DATETIME,
  inquilino INT NOT NULL,
  id_imovel INT NOT NULL,
  FOREIGN KEY (inquilino) REFERENCES clientes(id_cliente),
  FOREIGN KEY (id_imovel) REFERENCES imoveis(id_imovel)
);

-- ---------------------------------------------------------------------------------------------------------
-- Inserção de dados

INSERT INTO corretores (creci, senha, data_nasc, nome, telefone, email) VALUES 
('J0123', '$2y$13$J0/b4V8tVzzdC.UWiZwx4OpWSVc8r4ylIPiA.v3oxdqKtZmcKNM6K', '2003-04-12', 'Gabriel Assunção', '4122648187', 'gabrielbrunhara@alunos.utfpr.edu.br'),
('J4567', '$2y$13$7OLpVlvrM.TZyZ7ccnu3N.03ZE2teOeC/QKDKlpTu6UDPddCMmxTW', '2002-03-20', 'João Augusto', '1228611876', 'jsantos.2021@alunos.utfpr.edu.br'),
('J8910', '$2y$13$QPgBc6cFl9bY6bqPOTzcP.77.qVqcrXQeCI7RqsS.CyqYjwyCoMhC', '2002-03-23', 'Luis Nathan', '42928231876', 'roncolato@alunos.utfpr.edu.br'),
('J1112', '$2y$13$wtz3m3cNlDLNOyNQgylM0uSTw1TkE7PNZPAOfqOEz2tKoyij1Tj6O', '1996-11-17', 'Wagner Cordeiro', '42980224425', 'wagnercordeiro@alunos.utfpr.edu.br');
