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
  tipo_imovel ENUM('Apartamento', 'Casa Residencial', 'Chácara', 'Comercial', 'Condomínio', 'Terreno'),
  tipo_contrato ENUM('Locação', 'Venda', 'Locação/Venda'),
  cep INTEGER NOT NULL,
  rua VARCHAR(100),
  bairro VARCHAR (50),
  numero INTEGER,
  cidade VARCHAR(50),
  estado VARCHAR(2),
  valor DOUBLE(11, 2),
  foto TEXT,
  condominio BOOLEAN,
  area_total INT,
  dormitorios INT,
  banheiros INT,
  garagem INT,
  proprietario INT NOT NULL,
  chave_disponivel BOOLEAN,
  imovel_disponivel BOOLEAN,
  FOREIGN KEY (proprietario) REFERENCES clientes(id_cliente)
);

CREATE TABLE visitacao(
  id_visitacao INTEGER AUTO_INCREMENT PRIMARY KEY,
  data_inicial DATETIME,
  data_final DATETIME,
  cliente INT,
  imovel INT,
  corretor INT,
  FOREIGN KEY (cliente) REFERENCES clientes(id_cliente),
  FOREIGN KEY (imovel) REFERENCES imoveis(id_imovel),
  FOREIGN KEY (corretor) REFERENCES corretores(id_corretor)
);

CREATE TABLE contratos (
  id_contrato INTEGER AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('Locação', 'Venda'),
  data_inicial DATETIME,
  data_final DATETIME,
  inquilino INT NOT NULL,
  id_imovel INT NOT NULL,
  assinado BOOLEAN,
  FOREIGN KEY (inquilino) REFERENCES clientes(id_cliente),
  FOREIGN KEY (id_imovel) REFERENCES imoveis(id_imovel)

);

-- ---------------------------------------------------------------------------------------------------------
-- Inserção de dados

INSERT INTO corretores (creci, senha, data_nasc, nome, telefone, email) VALUES 
('J0123', '$2y$13$J0/b4V8tVzzdC.UWiZwx4OpWSVc8r4ylIPiA.v3oxdqKtZmcKNM6K', '2003-04-12', 'Gabriel Brunhara', '4122648187', 'gabrielbrunhara@alunos.utfpr.edu.br'),
('J4567', '$2y$13$7OLpVlvrM.TZyZ7ccnu3N.03ZE2teOeC/QKDKlpTu6UDPddCMmxTW', '2002-03-20', 'João Augusto', '1228611876', 'jsantos.2021@alunos.utfpr.edu.br'),
('J8910', '$2y$13$QPgBc6cFl9bY6bqPOTzcP.77.qVqcrXQeCI7RqsS.CyqYjwyCoMhC', '2002-03-23', 'Luis Nathan', '42928231876', 'roncolato@alunos.utfpr.edu.br'),
('J1112', '$2y$13$wtz3m3cNlDLNOyNQgylM0uSTw1TkE7PNZPAOfqOEz2tKoyij1Tj6O', '1996-11-17', 'Wagner Cordeiro', '42980224425', 'wagnercordeiro@alunos.utfpr.edu.br');

INSERT INTO clientes (nome, cpf, data_nasc, telefone, email, cep, rua, bairro, numero, cidade, estado) VALUES 
("João Oliveira", "444.555.666-77", "1995-04-18", '41888887777', 'joao.oliveira@email.com', 80230, "Rua das Palmeiras", "Jardim Primavera", 234, "Porto Alegre", "RS"),
("Fernanda Silva", "777.888.999-00", "1982-09-08", '41999998888', 'fernanda.silva@email.com', 80340, "Avenida das Flores", "Centro Histórico", 567, "São Paulo", "SP"),
("Rafael Santos", "333.222.111-00", "1990-12-01", '4134567890', 'rafael.santos@email.com', 70025, "Travessa do Bosque", "Bairro Novo", 890, "Curitiba", "PR"),
("Carla Pereira", "666.777.888-99", "1988-06-25", '4187654321', 'carla.pereira@email.com', 80540, "Alameda das Orquídeas", "Vila Verde", 1234, "Rio de Janeiro", "RJ"),
("Pedro Oliveira", "222.333.444-55", "1997-03-14", '4198765432', 'pedro.oliveira@email.com', 80030, "Rua dos Pinheiros", "Parque Industrial", 5678, "Fortaleza", "CE"),
("Aline Martins", "888.999.000-11", "1980-07-29", '4132109876', 'aline.martins@email.com', 70200, "Avenida dos Girassóis", "Jardim das Águas", 9012, "Salvador", "BA"),
("Marcos Silva", "111.222.333-44", "1993-11-06", '4187654323', 'marcos.silva@email.com', 80550, "Travessa das Azaleias", "Vila dos Pássaros", 3456, "Brasília", "DF"),
("Ana Souza", "555.444.333-22", "1987-05-17", '4198765434', 'ana.souza@email.com', 80240, "Rua das Violetas", "Jardim das Pedras", 7890, "Belo Horizonte", "MG"),
("Lucas Santos", "999.888.777-66", "1999-02-03", '4132109876', 'lucas.santos@email.com', 70030, "Avenida dos Ipês", "Parque das Águas", 123, "Recife", "PE"),
("Patrícia Pereira", "333.222.111-00", "1985-08-22", '4198765435', 'patricia.pereira@email.com', 70035, "Alameda das Palmas", "Vila Feliz", 456, "Manaus", "AM");

INSERT INTO imoveis (tipo_imovel, tipo_contrato, cep, rua, bairro, numero, cidade, estado, valor, foto, condominio, area_total, dormitorios, banheiros, garagem, proprietario, chave_disponivel, imovel_disponivel) 
VALUES 
('Apartamento', 'Locação', 80230, 'Rua das Flores', 'Centro Histórico', 101, 'Porto Alegre', 'RS', 1200.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', true, 80, 2, 1, 1, 2, true, true),
('Casa Residencial', 'Venda', 80340, 'Avenida dos Girassóis', 'Jardim das Águas', 205, 'São Paulo', 'SP', 350000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', false, 180, 4, 3, 2, 3, true, true),
('Chácara', 'Locação/Venda', 70025, 'Travessa do Bosque', 'Bairro Novo', 50, 'Curitiba', 'PR', 2000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', false, 5000, 2, 1, 0, 4, true, true),
('Comercial', 'Locação', 80540, 'Alameda das Orquídeas', 'Vila Verde', 789, 'Rio de Janeiro', 'RJ', 5000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', true, 300, NULL, NULL, NULL, 1, true, true),
('Condomínio', 'Venda', 80030, 'Rua dos Pinheiros', 'Parque Industrial', 456, 'Fortaleza', 'CE', 180000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', true, 150, 3, 2, 1, 2, true, true),
('Terreno', 'Venda', 70200, 'Avenida dos Ipês', 'Parque das Águas', 789, 'Salvador', 'BA', 80000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', false, 1000, NULL, NULL, NULL, 3, true, true),
('Apartamento', 'Locação', 70035, 'Alameda das Palmas', 'Vila Feliz', 101, 'Manaus', 'AM', 1500.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', true, 90, 2, 1, 1, 4, true, true),
('Casa Residencial', 'Venda', 80240, 'Rua das Violetas', 'Jardim das Pedras', 567, 'Belo Horizonte', 'MG', 280000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', false, 200, 3, 2, 2, 1, true, true),
('Chácara', 'Locação/Venda', 80020, 'Rua Flores', 'Centro', 123, 'Curitiba', 'PR', 2500.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', false, 3000, 2, 1, 0, 2, true, true),
('Comercial', 'Locação', 80550, 'Travessa das Azaleias', 'Vila dos Pássaros', 345, 'Brasília', 'DF', 8000.00, 'https://media.gazetadopovo.com.br/2022/07/12110820/comprar-imovel-bigstock-960x540.jpg', true, 500, NULL, NULL, NULL, 3, true, true);