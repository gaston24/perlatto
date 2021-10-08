create table ph_pedidos_opciones
(
ID int NOT NULL AUTO_INCREMENT,
condicion varchar(50) not null, 
estado int not null default 0,
valor int not null default 0,
primary key (ID)
);

insert into ph_pedidos_opciones (condicion) values ('MULTIPLO');
insert into ph_pedidos_opciones (condicion) values ('MINIMO');