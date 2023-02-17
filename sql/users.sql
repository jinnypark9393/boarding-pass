DROP TABLE IF EXISTS users;
CREATE TABLE users (id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30), password VARCHAR(30), email VARCHAR(30));
INSERT INTO users (username, password, email) VALUES ( "bob1234", "bobpwd1!", "bob@fakeemail.com" ), ( "alice1234", "alicepwd2@", "alice@email2.us" );
