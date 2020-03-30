CREATE TABLE users (
    id SERIAL,
    username VARCHAR(25) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    signUpDate DATETIME NOT NULL,
    profilePic VARCHAR(500)
);