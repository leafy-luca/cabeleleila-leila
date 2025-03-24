-- cria o banco de dados
CREATE DATABASE IF NOT EXISTS dsin_cabeleleila;
USE dsin_cabeleleila;

-- Criar a tabela CLIENTE
CREATE TABLE IF NOT EXISTS CLIENTE (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL
);

-- Criar a tabela SERVICO
CREATE TABLE IF NOT EXISTS SERVICO (
    id_servico INT AUTO_INCREMENT PRIMARY KEY,
    nome_servico VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL
);

-- Criar a tabela AGENDAMENTO
CREATE TABLE IF NOT EXISTS AGENDAMENTO (
    id_agendamento INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_hora DATETIME NOT NULL,
    status ENUM('Agendado', 'Confirmado', 'Cancelado') DEFAULT 'Agendado',
    alteracao_permitida BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente) ON DELETE CASCADE
);

-- Criar a tabela AGENDAMENTO_SERVICO
CREATE TABLE IF NOT EXISTS AGENDAMENTO_SERVICO (
    id_agendamento INT NOT NULL,
    id_servico INT NOT NULL,
    PRIMARY KEY (id_agendamento, id_servico),
    FOREIGN KEY (id_agendamento) REFERENCES AGENDAMENTO(id_agendamento) ON DELETE CASCADE,
    FOREIGN KEY (id_servico) REFERENCES SERVICO(id_servico) ON DELETE CASCADE
);

-- Criar a tabela HISTORICO_AGENDAMENTO
CREATE TABLE IF NOT EXISTS HIST
