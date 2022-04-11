CREATE TABLE foodCategories(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name tinytext not null
);

INSERT INTO foodCategories(name) VALUES('dairy');

INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('Leche', 'Gloria', '4', '1', '0', '1', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('Manzana', 'Pink Lady', '1', '2', '0', '0.10', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('spaghetti', 'Wong', '1', '3', '0', '0.10', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('Pollo', 'Wong', '11', '4', '0', '4', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('Brocoli', 'Wong', '0.5', '5', '0', '0.10', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('mondo snacks', 'Mondo', '9', '6', '0', '0.70', '1');
INSERT INTO product(name, company, price, catId, inStock, weight, size) VALUES('Tomato Sauce', 'Wong', '5', '7', '0', '0.5', '1');

create TABLE order(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int(11),
    totalPrice decimal(7,2) not null unsigned,
    createDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);
