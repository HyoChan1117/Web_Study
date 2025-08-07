use login;

create table board (
    id int auto_increment primary key,
    name varchar(100) not null,
    title varchar(255) not null, content text not null,
    pw varchar(255) not null,
    created_at datetime default current_timestamp,
    updated_at datetime default null on update current_timestamp );