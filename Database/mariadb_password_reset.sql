SELECT USER, HOST, password FROM mysql.user;
-- user,host,password 확인

USE mysql;
GRANT USAGE ON *.* TO 'root'@'localhost' IDENTIFIED BY 'php504';
FLUSH PRIVILEGES;
-- password 수정