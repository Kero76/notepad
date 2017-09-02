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

CREATE TABLE np_labels (
  label_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  label_title VARCHAR(255) NOT NULL
) ENGINE = innobd CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE np_tickets (
  ticket_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ticket_title VARCHAR(255) NOT NULL,
  ticket_content TEXT NOT NULL,
  ticket_release_date DATETIME NOT NULL,
  ticket_last_modified DATETIME NOT NULL,
  fk_label_id INTEGER NOT NULL,
  CONSTRAINT fk_label_id FOREIGN KEY(fk_label_id) REFERENCES np_labels(label_id)
) ENGINE = innobd CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# Insert new user named Kero76 with admin role
INSERT INTO `np_users` (`usr_id`, `usr_name`, `usr_mail`, `usr_password`, `usr_salt`, `usr_role`) VALUES
  (1, 'Kero76', 'nic.gille@gmail.com', '$2y$13$7y/A3Lx9EIdOJYbdoOKyI.MOLYD/G4BLTbxJ2udPmczMg4qD8jhkW', '2d24ed9c1415f913904a02d', 'ROLE_ADMIN');
