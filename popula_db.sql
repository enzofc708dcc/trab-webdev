CREATE TABLE vereadores(
	Numero char(5) PRIMARY KEY,
	Nome varchar(50),
	Partido varchar(20) not null,
	Url_Foto varchar(1000),
	Votos int default 0
);

CREATE TABLE vice_prefeitos(
	ID int PRIMARY KEY,
	Nome varchar(50),
	Partido varchar(20) not null,
	Url_Foto varchar(1000),
	Votos int default 0	
);

CREATE TABLE prefeitos(
	Numero char(2) PRIMARY KEY,
	Nome varchar(50),
	Partido varchar(20) not null,
	Url_Foto varchar(1000),
	ViceID int,
	Votos int default 0,
	FOREIGN KEY (ViceID) REFERENCES vice_prefeitos(ID)
);



INSERT INTO vereadores
VALUES('51222', 'Christianne Varão', 'PEN', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv1.jpg?v=1659026263635', 0);

INSERT INTO vereadores
VALUES('55555', 'Homero do Zé Filho', 'PSL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv2.jpg?v=1659026266780', 0);

INSERT INTO vereadores
VALUES('43333', 'Dandor', 'PV', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv3.jpg?v=1659026269770',0);

INSERT INTO vereadores
VALUES('15123', 'Filho', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv4.jpg?v=1659026272222',0);

INSERT INTO vereadores
VALUES('27222', 'Joel Varão', 'PSDC', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv5.jpg?v=1659026274534',0);

INSERT INTO vereadores
VALUES('45000', 'Professor Clebson Almeida', 'PSDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv6.jpg?v=1659026276689',0);


INSERT INTO vice_prefeitos
VALUES('1', 'Arão', 'PRP', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v3.jpg?v=1659026283582',0);

INSERT INTO vice_prefeitos
VALUES('2', 'Biga', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v2.jpg?v=1659026281145',0);

INSERT INTO vice_prefeitos
VALUES('3', 'João Rodrigues', 'PV', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v1.jpg?v=1659026278850',0);

INSERT INTO vice_prefeitos
VALUES('4', 'Francisca Ferreira Ramos', 'PPL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v4.jpg?v=1659026286366',0);

INSERT INTO vice_prefeitos
VALUES('5', 'Malú', 'PC do B', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v5.jpg?v=1659026288547',0);


INSERT INTO prefeitos
VALUES('12', 'Chiquinho do Adbon', 'PDT', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp3.jpg?v=1659026250650', 1, 0);

INSERT INTO prefeitos
VALUES('15', 'Malrinete Gralhada', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp2.jpg?v=1659026246696', 2, 0);

INSERT INTO prefeitos
VALUES('45', 'Dr. Francisco', 'PSC', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp1.jpg?v=1659026242803', 3,0);

INSERT INTO prefeitos
VALUES('54', 'Zé Lopes', 'PPL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp4.jpg?v=1659026254797', 4,0);

INSERT INTO prefeitos
VALUES('65', 'Lindomar Pescador', 'PC do B', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv5.jpg?v=1659026274534', 5,0);
