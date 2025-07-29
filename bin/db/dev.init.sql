GRANT ALL PRIVILEGES ON straininfo.* TO strinf@'%' IDENTIFIED BY 'password2';
FLUSH PRIVILEGES;
SET GLOBAL innodb_compression_algorithm='zlib';
