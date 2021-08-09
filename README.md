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
