# Characters and Novels of Robertson Davies

Davies has a knack for coming up with interesting and unique names for his characters. This API serves up information about the characters to [this](https://github.com/TYLER-JM/davies_vue) project.

### API Endpoints


- GET: `http://localhost/davies_characters/index.php/novels` for a list of the novels in the database

- GET: `http://localhost/davies_characters/index.php/characters/:id` for all information on a single character

- GET: `http://localhost/davies_characters/index.php/characters/search/:query` to search the database by first and last name

- POST: `http://localhost/davies_characters/index.php/characters/add` to add characters (and the Novel if it doesn't already exist)

- GET: `https://localhost/davies_characters` for a list of the characters in the database (as a JSON object) (no longer used)

#### coming soon

- DELETE: (to delete characters or Novels from the database)

- GET: (get info on one specific character) (implemented!)

### Tech Stack

- PHP (CodeIgniter 3)
- MySQL
---
## Setup

1. Fork and clone or download this repository.
2. Move the folder to your local server
3. Create a MySQL database to connect to the API
4. Configure the database connection via *davies_characters/application/config/database.php*. Namely the *username*, *password*, and *database*, ensuring they match your local setup
5. From the command line, logged into MySQL and using your new database, you can create the tables by running the SQL files in the **davies_characters/schema**. The exact path may vary:

`mysql> source ~/Sites/davies_characters/schema/01_tables.sql`

6. You can seed the database with the seed files:

`mysql> source ~/Sites/davies_characters/schema/02_novel_seeds.sql`

`mysql> source ~/Sites/davies_characters/schema/03_person_seeds.sql`

`mysql> source ~/Sites/davies_characters/schema/04_join_seeds.sql`
