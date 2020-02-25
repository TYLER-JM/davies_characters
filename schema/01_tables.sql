-- Drop and recreate Characters table
DROP TABLE IF EXISTS novel CASCADE;
DROP TABLE IF EXISTS person CASCADE;
DROP TABLE IF EXISTS person_novel CASCADE;

CREATE TABLE  novel (
	id SERIAL PRIMARY KEY NOT NULL,
	title VARCHAR(255),
	year_published SMALLINT
);

CREATE TABLE person (
  id SERIAL PRIMARY KEY NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  birth_name VARCHAR(255),
	nick_name VARCHAR(255),
	hometown VARCHAR(255),
	bio TEXT NOT NULL,
	birth_day SMALLINT,
	birth_month VARCHAR(255),
	birth_year SMALLINT,
	death_day SMALLINT,
	death_month VARCHAR(255),
	death_year SMALLINT
);

CREATE TABLE person_novel (
	id SERIAL PRIMARY KEY NOT NULL,
	novel_id INTEGER REFERENCES novel(id) ON DELETE CASCADE,
	person_id INTEGER REFERENCES person(id) ON DELETE CASCADE
);
