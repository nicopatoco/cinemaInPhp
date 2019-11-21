CREATE DATABASE MovieDB;
USE MovieDB;

CREATE TABLE Cinemas
(
	cinema_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cinema_name VARCHAR(50) NOT NULL,
    cinema_location VARCHAR(50) NOT NULL
)Engine=InnoDB;

CREATE TABLE Genres
(
	genre_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    genre_description VARCHAR(50) NOT NULL
)Engine=InnoDB;

CREATE TABLE Movies
(
	movie_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    movie_name VARCHAR(100) NOT NULL,
    movie_language VARCHAR(100) NOT NULL,
    duration INT,
    movie_image VARCHAR(100) NOT NULL,
    overview VARCHAR(1000) NOT NULL
)Engine=InnoDB;

CREATE TABLE MoviesGenres
(
    movies_genres_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    movie_id INT NOT NULL,
    genre_id INT NOT NULL,
    CONSTRAINT movie_id FOREIGN KEY(movie_id) references Movies(movie_id),
    CONSTRAINT genre_id FOREIGN KEY(genre_id) references Genres(genre_id)
)Engine=InnoDB;

CREATE TABLE Rooms
(
    room_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    room_name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    cinema_id INT NOT NULL,
    CONSTRAINT cinema_id FOREIGN KEY(cinema_id) references Cinemas(cinema_id)
)Engine=InnoDB;

CREATE TABLE Schedules
(
    schedule_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    room_id INT NOT NULL,
    schedule_date DATETIME NOT NULL,
    CONSTRAINT room_id FOREIGN KEY(room_id) references Rooms(room_id)
)Engine=InnoDB;

CREATE TABLE Payments
(
    payment_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    payment_name  VARCHAR(100) NOT NULL
)Engine=InnoDB;

CREATE TABLE Prices
(
    price_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    amount FLOAT NOT NULL,
    price_description VARCHAR(50) NOT NULL
)Engine=InnoDB;

CREATE TABLE Functions
(
    function_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    movie_id INT NOT NULL,
    price_id INT NOT NULL,
    schedule_id INT NOT NULL,
    CONSTRAINT function_movie_id FOREIGN KEY(movie_id) references Movies(movie_id),
    CONSTRAINT price_id FOREIGN KEY(price_id) references Prices(price_id),
    CONSTRAINT function_schedule_id FOREIGN KEY(schedule_id) references Schedules(schedule_id) on delete cascade
)Engine=InnoDB;

CREATE TABLE UsersTypes
(
	type_id INT AUTO_INCREMENT NOT NULL,
    type_description VARCHAR(100) NOT NULL,
    constraint pk_type_id PRIMARY KEY (type_id)
)Engine=InnoDB;

CREATE TABLE Users
(
	user_id INT AUTO_INCREMENT NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(100) NOT NULL,
    type_id INT NOT NULL,
    CONSTRAINT fk_type_id FOREIGN KEY(type_id) REFERENCES UsersTypes(type_id),
    CONSTRAINT pk_User_id PRIMARY KEY (user_id)
)Engine=InnoDB;

CREATE TABLE Entries
(
    entry_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    function_id INT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    price_id INT NOT NULL,
    discount FLOAT NOT NULL,
    total FLOAT NOT NULL,
    CONSTRAINT function_id FOREIGN KEY(function_id) references Functions(function_id),
    CONSTRAINT user_id FOREIGN KEY(user_id) references Users(user_id),
    CONSTRAINT entry_price_id FOREIGN KEY(price_id) references Prices(price_id)
)Engine=InnoDB;

insert into UsersTypes (type_description) value ("Admin");
insert into UsersTypes (type_description) value ("Normal");

insert into Users (user_email, user_password, type_id) value ("admin@admin", "123", 1);