CREATE DATABASE IF NOT EXISTS occurence_db;
CREATE USER 'occurence_user'@'%' IDENTIFIED BY 'strongpassword';
GRANT ALL PRIVILEGES ON occurence_db.* TO 'occurence_user'@'%';
FLUSH PRIVILEGES;
USE occurence_db;
SOURCE /docker-entrypoint-initdb.d/ob_database.sql;

