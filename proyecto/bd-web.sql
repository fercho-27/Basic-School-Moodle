CREATE TABLE usuario(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	username char(12) UNIQUE NOT NULL,
	password char(12) NOT NULL,
	correo char(64) UNIQUE NOT NULL,
	tipo tinyint NOT NULL,
	estado tinyint NOT NULL
);

CREATE TABLE empresa(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre char(64) UNIQUE NOT NULL,
	ubicacion char(128) NOT NULL,
	rfc char(12) UNIQUE NOT NULL,
	telefono char(10) NOT NULL,
	fk_usuario int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE
);

CREATE TABLE administrador(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre char(64) NOT NULL,
	rfc char(13) UNIQUE NOT NULL,
	fk_usuario int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE
);

CREATE TABLE alumno(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre char(64) NOT NULL,
	carrera tinyint NOT NULL,
	telefono char(10) NOT NULL,
	semestre tinyint NOT NULL,
	num_control char(9) UNIQUE NOT NULL,
	fk_usuario int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE
);

CREATE TABLE profesor(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre char(64) NOT NULL,
	carrera tinyint NOT NULL,
	telefono char(10) NOT NULL,
	rfc char(13) UNIQUE NOT NULL,
	fk_usuario int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE
);

CREATE TABLE proyecto(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre varchar(512) NOT NULL,
	tipo varchar(512) NOT NULL,
	vacantes tinyint NOT NULL,
	duracion tinyint NOT NULL,
	requisitos varchar(512) NOT NULL,
	descripcion varchar(512) NOT NULL,
	fk_empresa int NOT NULL,
	FOREIGN KEY(fk_empresa) REFERENCES empresa(id) on DELETE CASCADE
);

CREATE TABLE solicitud(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	tipo tinyint NOT NULL,
	estado tinyint NOT NULL,
	fk_usuario int NOT NULL,
	fk_proyecto int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE,
	FOREIGN KEY(fk_proyecto) REFERENCES proyecto(id) on DELETE CASCADE
);

CREATE TABLE comentario(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	descripcion varchar(512) NOT NULL,
	fk_usuario int NOT NULL,
	fk_proyecto int NOT NULL,
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id) on DELETE CASCADE,
	FOREIGN KEY(fk_proyecto) REFERENCES proyecto(id) on DELETE CASCADE
);

INSERT INTO usuario(id, username, password, correo, tipo, estado) VALUES (NULL, 'Itver', 'hMW3ARhrkhoR', 'itver@itver.edu.mx', 1, 1);
UPDATE usuario SET id = 0 WHERE username = 'Itver'; 
INSERT INTO empresa(id, nombre, ubicacion, rfc, telefono, fk_usuario) VALUES (NULL, 'Instituto Tecnologico de Veracruz', 'Av. Miguel Angel de Quevedo 2779, Formando Hogar, 91897 Veracruz, Ver.', 'ITV570301ITV', '2299341500', 0);
UPDATE empresa SET id = 0 WHERE fk_usuario = 0;
INSERT INTO usuario(id,username,password,correo,tipo, estado) VALUES (NULL,'admin','a1234A','admin@itver.edu.mx',0, 1);
UPDATE usuario SET id = 1 WHERE username = 'admin'
INSERT INTO administrador(id,nombre,rfc,fk_usuario) VALUES (NULL,'Administrador Default','ADMI123456HVZ',1);
UPDATE administrador SET id = 0 WHERE fk_usuario = 1;