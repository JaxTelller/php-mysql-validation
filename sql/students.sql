CREATE TABLE students (

	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	last_name VARCHAR(15) NOT NULL,
	first_name VARCHAR(15) NOT NULL,
	isikukood VARCHAR(11) NOT NULL UNIQUE,
	grade INT (1) NOT NULL,
	email VARCHAR(20) NOT NULL,
    message VARCHAR(250) NULL
	
	
);

SELECT * FROM students;