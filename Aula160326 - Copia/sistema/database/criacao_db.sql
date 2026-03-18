CREATE DATABASE resende_tech_db;
USE resende_tech_db; /* Corrigido de "bd" para "db" */

CREATE TABLE tbl_maquinas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    status_operacional VARCHAR(50) DEFAULT 'Ativo',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* ⚡ DESAFIO 1: ALTER TABLE para adicionar Data/Hora e Severidade */
ALTER TABLE tbl_maquinas 
ADD COLUMN data_falha DATETIME, 
ADD COLUMN nivel_severidade INT;

/* ⚡ DESAFIO 2: Criação de usuário restrito e concessão de privilégios */
CREATE USER 'admin'@'localhost' IDENTIFIED BY ' ';
GRANT SELECT, INSERT, UPDATE ON resende_tech_db.tbl_maquinas TO 'admin'@'localhost';
FLUSH PRIVILEGES;