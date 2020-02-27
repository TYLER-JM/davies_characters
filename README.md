# Characters and Novels of Robertson Davies

Davies has a knack for coming up with interesting and unique names for his characters. This API serves up information about the characters to [this](https://github.com/TYLER-JM/davies_vue) project.

### API Endpoints

- GET: `https://localhost/davies_characters` for a list of the characters in the database (as a JSON object)

- GET: `http://localhost/davies_characters/index.php/novels` for a list of the novels in the database

- GET: `http://localhost/davies_characters/index.php/characters/:id` for all information on a single character

- POST: `http://localhost/davies_characters/index.php/characters/add` to add characters (and the Novel if it doesn't already exist)

#### coming soon

- DELETE: (to delete characters or Novels from the database)

- GET: (get info on one specific character)

### Tech Stack

- PHP (CodeIgniter 3)
- MySQL
