create database Meconomiza
default character set utf8
default collate utf8_general_ci;

use Meconomiza;

create table Cliente(
Cod_Cliente int not null primary key auto_increment,
Nome varchar (50) not null,
Sexo enum('M', 'F'),
Nacionalidade varchar(20) default 'Brasil',
Data_Nasc date, 
Data_Cadastro date,
RG char(10),
CPF int (11)
)default charset = utf8;

create table Pedido(
Cod_Pedido int not null primary key auto_increment,
Data_Pedido date, 
Valor_Total decimal(6,2)
)default charset = utf8;

desc Pedido;

alter table Pedido 
add Cod_Cliente int (11);

alter table Pedido
add foreign key (Cod_Cliente) 
references Cliente(Cod_Cliente);

create table Fabricante(
Cod_Fabricante int not null primary key auto_increment,
Nome varchar (50) not null,
Data_Aquisicao date, 
UF char(2),
Cidade varchar(35),
Bairro varchar(30),
Logradouro varchar(50),
Complemento varchar(30)
)default charset = utf8;

desc fabricante;

create table Produtos(
Cod_Produto int not null primary key auto_increment,
Nome varchar (60) not null,
Valor decimal(6,2),
Quantidade int(4),
Data_Garantia date, 
Data_Fabricacao date,
Descricao varchar(60)
)default charset = utf8;

desc Produtos;

alter table Produtos 
add Cod_Fabricante int (11);

alter table Produtos
add foreign key (Cod_Fabricante) 
references Fabricante(Cod_Fabricante);

create table Contato(
Cod_Contato int not null primary key auto_increment,
Numero_Telefone int(11) not null,
Email varchar(50) 
)default charset = utf8;

desc Contato;

alter table Contato 
add Cod_Cliente int (11);

alter table Contato
add foreign key (Cod_Cliente) 
references Cliente(Cod_Cliente);

alter table Contato 
add Cod_Fabricante int (11);

alter table Contato
add foreign key (Cod_Fabricante) 
references Fabricante(Cod_Fabricante);