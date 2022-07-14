# larablog
Simple Laravel v.8.x Blog

1. Клонируем репозиторий
2. Запускаем Docker командой docker-compose up -d

В Docker установлен Ubuntu, nginx, php 7.4 и MySQL 8.0

3. Переходим в запущенный под Docker-ом Linux командой docker exec -it project_app bash

Дальше все практически стандартно.

4. Создаем файлик .env с настройками

DB_HOST=db

DB_PORT=3306

DB_DATABASE=larablog_test

DB_USERNAME=root

DB_PASSWORD=root


Прописываем настройки для отправки почтовых уведомлений.

5. Обновляем composer
6. Запускаем миграции и создаем тестовые данные в базе php artisan migrate:fresh --seed
7. Создаем симлинк на папку с фотографиями блога
php artisan storage:link

8. Если вдруг не отобразиться пагинация, то выполняем команду
php artisan vendor:publish --tag=laravel-pagination


Блог доступен по адресу http://localhost:8800

Порт базы данных для внешнего подключения к Docker: 8200

Первый пользователь в базе является админом.
