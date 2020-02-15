-- Drop and recreate Characters table
DROP TABLE IF EXISTS novels CASCADE;
DROP TABLE IF EXISTS characters CASCADE;

CREATE TABLE  novels (
	id SERIAL PRIMARY KEY NOT NULL,
	title VARCHAR(255),
	year_published SMALLINT
);

CREATE TABLE characters (
  id SERIAL PRIMARY KEY NOT NULL,
	novel_id INTEGER REFERENCES novels(id) ON DELETE CASCADE,
  first_name VARCHAR(255),
  last_name VARCHAR(255)
);
