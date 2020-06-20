create database ranking;

use ranking;

create table users(
	id int not null PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100) not null,
    email varchar(150) not null UNIQUE,
    senha varchar(50) not null
);

create table categoria(
	id int not null PRIMARY KEY AUTO_INCREMENT,
    nome_categoria varchar(100) not null,
    user_id int not null,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

create table itens(
	id int not null AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100) not null,
    posicao int not null,
    categoria_id int not null,
    user_id int not null,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);
