-- Inserindo clientes
INSERT INTO CLIENTE (nome, telefone, email, senha, cpf) VALUES
('Carlos Silva', '11987654321', 'carlos@email.com', 'senha123', '123.456.789-00'),
('Ana Souza', '11976543210', 'ana@email.com', 'senha456', '987.654.321-00');

-- Inserindo serviços
INSERT INTO SERVICO (nome_servico, descricao, preco) VALUES
('Corte de Cabelo', 'Corte profissional com finalização', 50.00),
('Hidratação Capilar', 'Tratamento de hidratação profunda', 80.00),
('Pintura', 'Coloração completa do cabelo', 120.00);

-- Inserindo agendamentos
INSERT INTO AGENDAMENTO (id_cliente, data_hora, status, alteracao_permitida) VALUES
(1, '2025-03-18 10:00:00', 'Agendado', TRUE),
(2, '2025-03-19 14:00:00', 'Confirmado', FALSE),
(1, '2025-03-20 16:00:00', 'Agendado', TRUE);

-- Associando serviços aos agendamentos
INSERT INTO AGENDAMENTO_SERVICO (id_agendamento, id_servico) VALUES
(1, 1), -- Carlos agendou um corte de cabelo
(1, 2), -- Carlos também marcou uma hidratação no mesmo agendamento
(2, 3), -- Ana marcou uma pintura
(3, 1); -- Carlos agendou outro corte de cabelo

-- Inserindo histórico de alterações nos agendamentos
INSERT INTO HISTORICO_AGENDAMENTO (id_agendamento, status_anterior, status_novo) VALUES
(1, 'Agendado', 'Confirmado'),
(2, 'Confirmado', 'Cancelado');

-- Criando segundo administrador para testes
INSERT INTO ADMINISTRADOR (nome, email, senha) VALUES
('admin', 'admin@email.com', 'admin_pass');

-- Inserindo dados gerenciais (exemplo de uma semana)
INSERT INTO GERENCIA (data_periodo, total_agendamentos, faturamento) VALUES
('2025-03-11', 5, 350.00),
('2025-03-18', 3, 250.00);
