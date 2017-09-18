DROP TABLE IF EXISTS np_users;
DROP TABLE IF EXISTS np_tickets;
DROP TABLE IF EXISTS np_labels;

CREATE TABLE np_users (
  usr_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  usr_name VARCHAR(50) NOT NULL,
  usr_mail VARCHAR(255) NOT NULL,
  usr_password VARCHAR(88) NOT NULL,
  usr_salt VARCHAR(23) NOT NULL,
  usr_role VARCHAR(50) NOT NULL,
  usr_biography TEXT,
  usr_website VARCHAR(255),
  usr_twitter VARCHAR(255),
  usr_goodreads VARCHAR(255)
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
  ticket_is_archive BOOLEAN NOT NULL,
  ticket_is_star BOOLEAN NOT NULL,
  fk_label_id INTEGER NOT NULL,
  CONSTRAINT fk_label_id FOREIGN KEY(fk_label_id) REFERENCES np_labels(label_id)
) ENGINE = innobd CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# Insert user admin with password admin
INSERT INTO `np_users` (`usr_id`, `usr_name`, `usr_mail`, `usr_password`, `usr_salt`, `usr_role`, `usr_biography`, `usr_website`, `usr_twitter`, `usr_goodreads`) VALUES
  (1, 'admin', 'admin@admin.com', '$2y$13$3LhE3OdMCn/pb4BLm0Gu3ebqi3g/SWwU4zduHizbXG0fiCfnkI/tC', '2ddd44c225d8574afbbdcf8', 'ROLE_ADMIN', "", "", "", "");

# Insert Label
INSERT INTO `np_labels` (`label_id`, `label_title`) VALUES
  (1, 'Music'),
  (2, 'Lorem Ipsum');

# Insert Ticket
INSERT INTO `np_tickets` (`ticket_id`, `ticket_title`, `ticket_content`, `ticket_release_date`, `ticket_last_modified`, `ticket_is_archive`, `ticket_is_star`, `fk_label_id`) VALUES
  (1, 'Metal band', '<p>This is a link about new metal band :&nbsp;<a title=\"Amaranthe - The Nexus\" href=\"https://www.youtube.com/watch?v=SxOybZcRXhI\">https://www.youtube.com/watch?v=SxOybZcRXhI</a></p>', '2017-09-18 14:48:42', '2017-09-18 14:48:42', 0, 0, 1),
  (2, 'Lorem Ipsum', '<p><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi leo quam, sollicitudin ut nisi a, pellentesque consequat augue. Cras commodo sem eget turpis varius, vel placerat ex ultricies. Donec vitae malesuada mi, ac egestas mi. Donec vel lacinia felis, a malesuada lacus. Etiam vestibulum est pulvinar massa convallis, id facilisis est vehicula. Nunc varius nulla enim, ac commodo dolor commodo nec. Phasellus metus lacus, egestas ut diam non, elementum aliquam metus. Pellentesque at mauris malesuada, interdum leo ut, pulvinar metus. Mauris in velit dui. Fusce commodo diam eget nulla ultrices commodo. Aenean pretium, ipsum nec malesuada vestibulum, tellus justo varius dui, vel efficitur ex lorem vel risus. In dignissim placerat urna a auctor. Integer vel malesuada sem, et ornare diam. Nunc commodo lacus sed tortor hendrerit, at scelerisque dui sollicitudin.</span></p>', '2017-09-18 14:49:24', '2017-09-18 14:49:24', 0, 1, 2);
