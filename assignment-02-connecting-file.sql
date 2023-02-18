CREATE DATABASE assignment_02;
USE assignment_02;

CREATE TABLE collections(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(200) NOT NULL,
    value DECIMAL(9,2) NOT NULL,
    signature_by VARCHAR(50)
);

SELECT * FROM collections;