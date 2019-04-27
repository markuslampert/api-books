Use books_db;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS genres;

CREATE TABLE genres (
  genre_id int(11) NOT NULL AUTO_INCREMENT,
  genre_name varchar(255) NOT NULL,
  PRIMARY KEY (genre_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO genres (genre_name) VALUES
('drama'),
('comedy'),
('horror'),
('romance'),
('detective_noval'),
('fantasy'),
('science_fiction'),
('science'),
('humanities'),
('biography'),
('dictionary');

CREATE TABLE books (
  book_id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  author_last_name varchar(255) NOT NULL,
  publishing_company varchar(255) NOT NULL,
  year int(11) NOT NULL,
  genre_id int(11) NOT NULL,
  PRIMARY KEY (book_id),
  FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO books (title,author_last_name,
                   publishing_company,year,genre_id) VALUES
('Maria Stuart','Schiller','Reclam',2012,1),
('Farm der Tiere','Orwell','Diogenes',1985,2),
('Es','King','Heyne',2017,3),
('The Notebook','Sparks','Grand Central Publishing',2014,4),
('Sherlock Holmes Stories','Doyle','Black Cat Publishing',2016,5),
-- ('Der Hobbit','Tolkien','Klett',2009,6),
('Dune','Herbert','Hodder And Stoughton Ltd.',2015,7),
('Apple Script','Schulz','Smart Books',2009,8),
('Geschichte der USA','Heideking','Utb',2008,9),
('Steve Jobs','Isaacson','Btb',2012,10),
('Duden - Die deutsche Rechtschreibung','Dudenredaktion','Duden',2017,11);
