create database crud_laravel;

use crud_laravel;

create table fornecedor(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);
create table produtos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2),
    fornecedor_id INT NOT NULL,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id)
);


INSERT INTO fornecedors(nome) values("jose");
INSERT INTO fornecedors(nome) values("joao");
INSERT INTO fornecedors(nome) values("kessia");

INSERT INTO produtos(nome, valor, fornecedor_id) values("arroz", 27.80, 2);
INSERT INTO produtos(nome, valor, fornecedor_id) values("macarrão", 9.9, 3);
INSERT INTO produtos(nome, valor, fornecedor_id) values("doritos", 7.69, 4);
INSERT INTO produtos(nome, valor, fornecedor_id) values("batata frita", 12.50, 4);




