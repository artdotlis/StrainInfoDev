-- SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
--
-- SPDX-License-Identifier: MIT

GRANT ALL PRIVILEGES ON straininfo.* TO strinf@'%' IDENTIFIED BY 'password2';
FLUSH PRIVILEGES;
SET GLOBAL innodb_compression_algorithm='zlib';
