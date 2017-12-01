CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(32),
    nombres VARCHAR(32), 
    apellidos VARCHAR(32) NOT NULL,
    fecha_nacimiento DATE,
	email VARCHAR(100) NOT NULL,
     
    password VARCHAR(32) NOT NULL
);  

--MD5[devuelve una cadena de dígitos hexadecimales]
INSERT INTO users ( nombres, apellidos, fecha_nacimiento, email,username, password) VALUES 
  ( 'Juan', 'Perez', '1990-05-23','jperez@hotmail.com','juan23',MD5('juan')),
  ('Smith', 'Gonzales','1994-12-05','sgonzalez@hotmail.com','smith05',MD5('smith')),
  ('Thomas','Baker','1995-11-19','tbaker@hotmail.com','thomas19',MD5('thomas')),
  ( 'Carlos', 'Castro', '1992-12-21','ccastro@hotmail.com','carlos21',MD5('carlos')),
  ('Taylor','Carter','1991-10-13','tcarter@hotmail.com','taylor13',MD5('taylor')),
  ( 'Maya', 'Mendoza', '1995-08-03','mmendoza@hotmail.com','maya03',MD5('maya'));
  
--h_d[hora y dia]
-- sus id no se repiten 
CREATE TABLE message(
	id INT PRIMARY KEY AUTO_INCREMENT,
    remitente INTEGER,
    destinatario INTEGER, 
	h_d TIMESTAMP, 
    mensaje VARCHAR(1000),
    FOREIGN KEY(remitente) REFERENCES users(id),
    FOREIGN KEY(destinatario) REFERENCES users(id)
);

INSERT INTO message(remitente,destinatario, mensaje) VALUES
	('2','3','almost ready'),
	('1','2','right');