USE hw1;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
    )Engine = InnoDB;
    
create table preferiti(
	id_user integer not null,
    id_movie varchar(30) not null,
    title varchar(255),
    info varchar(255),
    pic varchar(255),
    primary key(id_user, id_movie),
    foreign key(id_user) references users(id)
)ENGINE=InnoDB;


