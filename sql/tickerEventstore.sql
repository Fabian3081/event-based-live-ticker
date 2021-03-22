CREATE DATABASE tickerEventstore;

CREATE TABLE tickerEvents (
    tickerEventID int auto_increment primary key,
    tickerEventType varchar(45),
    tickerEventData longtext
);

CREATE TABLE adminLogin (
    id int auto_increment primary key,
    name varchar(45),
    password varchar(100)
);