DROP TABLE IF EXISTS COMMMENTAIRE;
DROP TABLE IF EXISTS POST;
DROP TABLE IF EXISTS ADMINISTRATEUR;
DROP TABLE IF EXISTS CATEGORY;


CREATE TABLE IF NOT EXISTS CATEGORY(
  idCategory INT AUTO_INCREMENT,
  name VARCHAR(50),
  PRIMARY KEY (idCategory)
)ENGINE=InnoDB	 DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS ADMINISTRATEUR(
  idAdmin INT AUTO_INCREMENT,
  username VARCHAR(50),
  password VARCHAR(1000),
  email VARCHAR(50),
  PRIMARY KEY (idAdmin)
)ENGINE=InnoDB	 DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS POST(
  idPost INT AUTO_INCREMENT,
  title VARCHAR(50),
  content TEXT,
  datePost DATE,
  idCategory INT,
  idAdmin INT,
  PRIMARY KEY (idPost),
  CONSTRAINT fk_post_category
    FOREIGN KEY (idCategory)
    REFERENCES CATEGORY(idCategory),
  CONSTRAINT fk_post_admin
    FOREIGN KEY (idAdmin)
    REFERENCES ADMINISTRATEUR(idAdmin)
)ENGINE=InnoDB	 DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS COMMMENTAIRE(
  idCommentaire INT AUTO_INCREMENT,
  author VARCHAR(50),
  content TEXT,
  date DATE,
  email VARCHAR(50),
  idPost INT,
  PRIMARY KEY (idCommentaire),
  CONSTRAINT fk_commentaire_post
    FOREIGN KEY (idPost)
    REFERENCES POST(idPost)
)ENGINE=InnoDB	 DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;


