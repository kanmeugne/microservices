USE test_db;

CREATE TABLE IF NOT EXISTS profils (
	email varchar(50) PRIMARY KEY,
	first_name varchar(50),
	last_name varchar(50),
	gender varchar(10),
	nationality varchar(50),
	birth_year int(5),
	birth_place varchar(50)
);

CREATE TABLE IF NOT EXISTS answers (
	email varchar(50),
	transport varchar(50),
	food varchar(50),
	clothes varchar(50),
	shoes varchar(50),
	houserent varchar(50),
	healthcare varchar(50)
);

