create table users(
	id bigint unsigned not null auto_increment primary key,
	first_name varchar(30) not null,
	last_name varchar(30) not null,
	email varchar(255) not null,
	password text not null,
	deleted_at datetime,
	updated_at datetime,
	created_at timestamp default current_timestamp 
)