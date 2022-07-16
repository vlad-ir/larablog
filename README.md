# larablog
Simple Laravel v.8.x Blog

1. Клонируем репозиторий
2. Запускаем Docker
```sh
docker-compose up -d
```
В Docker установлены Ubuntu, nginx, php 7.4, MySQL 8.0, phpMyAdmin

3. Переходим в запущенный под Docker-ом Linux
```sh 
docker exec -it project_app bash
```
Дальше все практически стандартно.

4. Создаем файлик .env с настройками
```dotenv
DB_HOST=db
DB_PORT=3306
DB_DATABASE=larablog_test
DB_USERNAME=root
DB_PASSWORD=root
```

Прописываем настройки для отправки почтовых уведомлений.

5. Обновляем composer
6. Запускаем миграции и создаем тестовые данные в базе
```sh
php artisan migrate:fresh --seed
```
9. Создаем симлинк на папку с фотографиями блога
```sh
php artisan storage:link
```
Список портов в проекте:
| Программа | Порт |
|-------------- | -------------- |
| **nginx** | 8800 |
| **phpmyadmin** | 8080 |
| **mysql** | 8200-внешний 3306-внутренний |


Блог доступен по адресу http://localhost:8800

По адресу http://localhost:8080 доступен phpMyAdmin

Порт базы данных для внешнего подключения к Docker: 8200

Первый пользователь в базе является админом.
