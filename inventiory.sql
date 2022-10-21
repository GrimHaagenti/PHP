DROP TABLE IF EXISTS armor_items;
DROP TABLE IF EXISTS weapon_items;
DROP TABLE IF EXISTS inventory_items;
DROP TABLE IF EXISTS armors;
DROP TABLE IF EXISTS weapons;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS armor_types;
DROP TABLE IF EXISTS weapon_types;
DROP TABLE IF EXISTS item_types;
DROP TABLE IF EXISTS bank_accounts;
DROP TABLE IF EXISTS users;

CREATE TABLE users(
id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(32),
nombre VARCHAR(48),
password CHAR(32),
phone VARCHAR(16),
birthdate DATE,
gender CHAR(1),
email VARCHAR(32),
nationality CHAR(2),
register DATETIME
);

CREATE TABLE bank_accounts(
id_bank_account INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
balance DECIMAL(12, 2),
id_user INT UNSIGNED NOT NULL,
FOREIGN KEY (id_user) REFERENCES users(id_user)
	ON DELETE RESTRICT
); 

CREATE TABLE item_types(
id_item_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
type VARCHAR(14),
icon VARCHAR(24)
);

CREATE TABLE weapon_types(
id_weapon_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
type VARCHAR(14),
icon VARCHAR(24)
);

CREATE TABLE armor_types(
id_armor_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
type VARCHAR(14),
icon VARCHAR(24)
);

CREATE TABLE items(
id_item INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
item VARCHAR(32),
description TEXT,
cost DECIMAL(12,2),
weight FLOAT,
rarity INT,
icon VARCHAR(34),
id_item_type INT UNSIGNED NOT NULL,
FOREIGN KEY (id_item_type) REFERENCES item_types(id_item_type)
	ON DELETE RESTRICT
);


CREATE TABLE weapons(
id_weapon INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
item VARCHAR(32),
description TEXT,
cost DECIMAL(12,2),
weight FLOAT,
rarity INT,
icon VARCHAR(34),
id_weapon_type INT UNSIGNED NOT NULL,
FOREIGN KEY (id_weapon_type) REFERENCES weapon_types(id_weapon_type)
	ON DELETE RESTRICT
);

CREATE TABLE armors(
id_armor INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
item VARCHAR(32),
description TEXT,
cost DECIMAL(12,2),
weight FLOAT,
rarity INT,
icon VARCHAR(34),
id_armor_type INT UNSIGNED NOT NULL,
FOREIGN KEY (id_armor_type) REFERENCES armor_types(id_armor_type)
	ON DELETE RESTRICT
);

CREATE TABLE inventory_items(
id_inventory_item INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_item INT UNSIGNED NOT NULL,
id_user INT UNSIGNED NOT NULL,
purchased DATETIME,
FOREIGN KEY (id_item) REFERENCES items(id_item)
	ON DELETE RESTRICT,
FOREIGN KEY (id_user) REFERENCES users(id_user)
	ON DELETE RESTRICT
);

CREATE TABLE weapon_items(
id_weapon_item INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_weapon INT UNSIGNED NOT NULL,
id_user INT UNSIGNED NOT NULL,
purchased DATETIME,
FOREIGN KEY (id_weapon) REFERENCES weapons(id_weapon)
	ON DELETE RESTRICT,
FOREIGN KEY (id_user) REFERENCES users(id_user)
	ON DELETE RESTRICT
);

CREATE TABLE armor_items(
id_armor_items INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_armor INT UNSIGNED NOT NULL,
id_user INT UNSIGNED NOT NULL,
purchased DATETIME,
FOREIGN KEY (id_armor) REFERENCES armors(id_armor)
	ON DELETE RESTRICT,
FOREIGN KEY (id_user) REFERENCES users(id_user)
	ON DELETE RESTRICT
);


