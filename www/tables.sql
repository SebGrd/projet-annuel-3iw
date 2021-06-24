DROP TABLE IF EXISTS articles;
CREATE TABLE articles
(
  id              smallint unsigned NOT NULL auto_increment,
  title           varchar(255) NOT NULL,
  summary         text NOT NULL,
  content         mediumtext,
  createdAt       date NOT NULL,
  updatedAt       date NOT NULL,

  PRIMARY KEY     (id)
);