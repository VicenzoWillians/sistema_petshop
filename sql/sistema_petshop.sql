Create database if not exists petshop;

use petshop;

create table if not exists dono
(
	id_dono int not null auto_increment,
    nome_dono varchar(40),
    telefone_dono varchar(50),
    qnt_pet int,
    primary key(id_dono)

) engine=innoDB;

create table if not exists pet
(
	id_pet int not null auto_increment,
    nome_pet varchar(40),
    idade_pet int,
    id_dono int,
    foreign key(id_dono) references dono(id_dono),
    primary key(id_pet, id_dono)

) engine=innoDB;

select * from dono;
select * from pet;
-- show tables;
-- drop database petshop;