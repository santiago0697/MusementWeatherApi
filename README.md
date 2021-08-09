# Santiago Correa Muñoz

# Set up

For setup this project run this commands inside directory:

---

```bash
docker-compose up -d --build
```

__This will launch docker instances__

```bash
docker-compose exec php composer install && composer run post-root-package-install
```

__This will install all dependencies that the project needs__

```bash
docker-compose exec php php artisan test
```

__Run tests__

```bash
docker-compose exec php php artisan weather
```

__Will execute the command that shows you in console the forecasts, remember to place your Weather api key inside .env__

# About the code

This has been developed using Hexagonal architecture and following SOLID, divided en 3 subdomain contexts:
- City: Contains all related to the cities that are allowed to retrieve the weather
- Weather: Contains the logic that allow get weather of a City
- Shared: Contains shared domain objects, value objects between subdomains

All code its tested, proved by use phpunit with code coverage

For local execution and development its used Docker with docker-compose.
