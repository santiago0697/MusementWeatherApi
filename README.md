# Set up
For setup this project run this commands inside directory:

---

```bash
docker-compose up -d --build
```
__This will launch docker instances__

```bash
docker-compose exec php composer install
```
__This will install all dependencies that the project needs__

```bash
docker-compose exec php php artisan weather
```
__Will execute the command that shows you in console the forecasts__

```bash
docker-compose exec php php artisan test
```
__Run tests__
