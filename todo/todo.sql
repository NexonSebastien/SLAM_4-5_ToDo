drop database if exists Todo;
create database Todo;
USE Todo

create table Todo (
	id int unsigned auto_increment not null,
	task varchar(255) not null,
	ordre int unsigned not null,
	completed tinyint(1) not null,
	primary key (id)
);

create user adminTodo@'%' identified by 'siojjr';
grant all privileges on Todo.* to adminTodo@'%' with grant option;