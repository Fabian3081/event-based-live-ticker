CREATE DATABASE tickerEventstore;

CREATE TABLE tickerEvents (
    tickerEventID int,
    tickerEventType varchar(45),
    tickerEventData longtext
);