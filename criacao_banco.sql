CREATE DATABASE resende_tech_db;
use resende_tech_bd

CREATE TABLE tbl_maquinas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    status_operacional VARCHAR(50) DEFAULT 'Ativo',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);