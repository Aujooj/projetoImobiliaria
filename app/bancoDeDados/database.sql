CREATE DATABASE Estelar;

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
  cpf VARCHAR(14) NOT NULL,
  data_nasc DATE NOT NULL,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL,
  cep INTEGER NOT NULL,
  rua VARCHAR(100),
  bairro VARCHAR (50),
  numero INTEGER,
  cidade VARCHAR(50),
  estado VARCHAR(2)
);

CREATE TABLE produto (
  cod_produto INTEGER AUTO_INCREMENT PRIMARY KEY,
  tipo VARCHAR(10),
  marca VARCHAR(20),
  armazenamento INTEGER,
  ram INTEGER,
  descricao VARCHAR(100),
  preco DECIMAL(10),
  quantidade INTEGER,
  processador VARCHAR(20)
);

INSERT INTO clientes (cpf, data_nasc, nome, telefone, email, cep, rua, bairro, numero, cidade, estado)
VALUES 
('477.686.585-82', '1980-10-30', 'Cristiane Figueiredo Silvino', '9122947039', 'cristiane.silvino@gmail.com', '66075420', 'Travessa Liberato de Castro', 'Guamá', '619', 'Belém', 'PA'),
('241.833.871-16', '2009-05-04', 'Osvaldo Barbosa Borner', '92971787280', 'osvaldo.borner@gmail.com', '69099250', 'Rua Indiana', 'Novo Aleixo', '515', 'Manaus', 'AM');

INSERT INTO produto (tipo, marca, armazenamento, ram, descricao, preco, quantidade, processador) 
VALUES 
('Celular', 'Motorola', 128, 4, 'Moto g42', 1079.10, 5, 'Snapdragon 680'),
('Tablet', 'Samsung', 128, 4, 'Galaxy Tab S7 FE ', 3799, 2, 'Kryo 570');

INSERT INTO corretores (creci, senha, data_nasc, nome, telefone, email) 
VALUES 
('12345678', '$2y$13$7OLpVlvrM.TZyZ7ccnu3N.03ZE2teOeC/QKDKlpTu6UDPddCMmxTW', '2002-03-20', 'João Augusto de Souza Santos', '1228611876', 'jsantos.2021@alunos.utfpr.edu.br'), 
('87654321', '$2y$13$wtz3m3cNlDLNOyNQgylM0uSTw1TkE7PNZPAOfqOEz2tKoyij1Tj6O', '1996-11-17', 'Wagner Cordeiro Gomes da Silva', '42980224425', 'wagnercordeiro@alunos.utfpr.edu.br');