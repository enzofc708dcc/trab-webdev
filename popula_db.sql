use heroku_d6ca8fc20cd1a0d;

CREATE TABLE vereadores(
	ID int PRIMARY KEY AUTO_INCREMENT,
	Numero char(5),
	Nome varchar(50),
	Partido varchar(20),
	Url_Foto varchar(1000),
	Votos int default 0
);

CREATE TABLE vice_prefeitos(
	ID int PRIMARY KEY,
	Nome varchar(50),
	Partido varchar(20),
	Url_Foto varchar(1000)
);

CREATE TABLE prefeitos(
	ID int PRIMARY KEY AUTO_INCREMENT,
	Numero char(2),
	Nome varchar(50),
	Partido varchar(20),
	Url_Foto varchar(1000),
	ViceID int,
	Votos int default 0,
	FOREIGN KEY (ViceID) REFERENCES vice_prefeitos(ID)
);



INSERT INTO vereadores(Numero, Nome, Partido, Url_Foto)
VALUES
	('51222', 'Christianne Varão', 'PEN', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv1.jpg?v=1659026263635'),
    ('55555', 'Homero do Zé Filho', 'PSL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv2.jpg?v=1659026266780'),
    ('43333', 'Dandor', 'PV', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv3.jpg?v=1659026269770'),
	('15123', 'Filho', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv4.jpg?v=1659026272222'),
	('27222', 'Joel Varão', 'PSDC', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv5.jpg?v=1659026274534'),
	('45000', 'Professor Clebson Almeida', 'PSDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv6.jpg?v=1659026276689'),
	(NULL, 'Nulo', NULL, NULL),
	(NULL, 'Branco', NULL, NULL);

INSERT INTO vice_prefeitos(ID,Nome, Partido, Url_Foto)
VALUES
	(1,'Arão', 'PRP', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v3.jpg?v=1659026283582'),
	(2,'Biga', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v2.jpg?v=1659026281145'),
	(3,'João Rodrigues', 'PV', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v1.jpg?v=1659026278850'),
	(4,'Francisca Ferreira Ramos', 'PPL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v4.jpg?v=1659026286366'),
	(5,'Malú', 'PC do B', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/v5.jpg?v=1659026288547');

INSERT INTO prefeitos(Numero, Nome, Partido, Url_Foto, ViceID)
VALUES
	('12', 'Chiquinho do Adbon', 'PDT', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp3.jpg?v=1659026250650', 1),
	('15', 'Malrinete Gralhada', 'MDB', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp2.jpg?v=1659026246696', 2),
	('45', 'Dr. Francisco', 'PSC', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp1.jpg?v=1659026242803', 3),
	('54', 'Zé Lopes', 'PPL', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cp4.jpg?v=1659026254797', 4),
	('65', 'Lindomar Pescador', 'PC do B', 'https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/cv5.jpg?v=1659026274534', 5),
	(NULL, 'Nulo', NULL, NULL, NULL),
	(NULL, 'Branco', NULL, NULL, NULL);
