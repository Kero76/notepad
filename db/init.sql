DROP TABLE IF EXISTS np_users;
DROP TABLE IF EXISTS np_tickets;
DROP TABLE IF EXISTS np_labels;

CREATE TABLE np_users (
  usr_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  usr_name VARCHAR(50) NOT NULL,
  usr_mail VARCHAR(255) NOT NULL,
  usr_password VARCHAR(88) NOT NULL,
  usr_salt VARCHAR(23) NOT NULL,
  usr_role VARCHAR(50) NOT NULL
) ENGINE = innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE np_tickets (
  ticket_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ticket_title VARCHAR(255) NOT NULL,
  ticket_content TEXT NOT NULL,
  fk_label_id INTEGER NOT NULL,
  CONSTRAINT fk_label_id FOREIGN KEY(fk_label_id) REFERENCES np_labels(label_id)
) ENGINE = innobd CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE np_labels (
  label_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  label_title VARCHAR(255) NOT NULL
) ENGINE = innobd CHARACTER SET utf8 COLLATE utf8_unicode_ci;
