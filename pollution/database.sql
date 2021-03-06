﻿DROP DATABASE if exists `pollution`;
CREATE DATABASE pollution DEFAULT CHARSET=utf8;
USE pollution;

CREATE TABLE IF NOT EXISTS user(
	id int NOT NULL AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	password varchar(24) NOT NULL,
	token varchar(255) default NULL,
	api_key varchar(255) default NULL,
	salt int default NULL,
	is_admin boolean default NULL,
PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

INSERT INTO user( username,password, is_admin) VALUES ("root","123",true);

CREATE TABLE IF NOT EXISTS api_requests(
	name varchar(255),
	request_type varchar(20),
	number_of_reqs int,
	api_key_of_req varchar(255),
	PRIMARY KEY (api_key_of_req)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS station(
	id varchar(50) NOT NULL,
	name varchar(20) NOT NULL,
	location varchar(30) NOT NULL,
PRIMARY KEY(id)

) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS dirt(

	dmy date ,
	h1 float NOT NULL,
	h2 float NOT NULL,
	h3 float NOT NULL,
	h4 float NOT NULL,
	h5 float NOT NULL,
	h6 float NOT NULL,
	h7 float NOT NULL,
	h8 float NOT NULL,
	h9 float NOT NULL,
	h10 float NOT NULL,
	h11 float NOT NULL,
	h12 float NOT NULL,
	h13 float NOT NULL,
	h14 float NOT NULL,
	h15 float NOT NULL,
	h16 float NOT NULL,
	h17 float NOT NULL,
	h18 float NOT NULL,
	h19 float NOT NULL,
	h20 float NOT NULL,
	h21 float NOT NULL,
	h22 float NOT NULL,
	h23 float NOT NULL,
	h24 float NOT NULL,
	name varchar(10) ,
	station_id varchar(50),
	FOREIGN KEY (station_id) REFERENCES station(id)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS edit(
	station_id varchar(50) NOT NULL,
	user_id int NOT NULL,
PRIMARY KEY(user_id,station_id),
FOREIGN KEY (user_id) REFERENCES user(id)
ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (station_id) REFERENCES station(id)
ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
