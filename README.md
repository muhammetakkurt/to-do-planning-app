# To-do planning app

Ports used in the project:
| Software | Port |
|-------------- | -------------- |
| **nginx** | 8082 |
| **phpmyadmin** | 8087 |
| **mysql** | 33010 |
| **php** | 9012 |

## Installation

1. Clone this project:

   ```sh
   git clone https://github.com/muhammetakkurt/to-do-planning
   ```

2. Inside the folders `./source` and `./` and Generate your own `.env` to docker compose with the next command:

   ```sh
   cp .env.example .env
   cp source/.env.example source/.env
   ```

3. Build the project whit the next commands:

   ```sh
   docker-compose up --build
   ```

4. Update Composer:
   ```sh
   docker-compose run --rm composer update
   ```
---