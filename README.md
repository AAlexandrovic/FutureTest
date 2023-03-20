Установка приложения:

1. Скопировать репозиторий командой https://github.com/AAlexandrovic/FutureTest.git 
Внутри docker-compose.yml Можно изменить значения на нужные, например если вы не хотите открывать приложение портом 8876(уже прописанным) , то измените порт на нужный Вам, например 8080:80.
Запустить сборку командой docker-compose up -d
(Должны быть установленны docker и docker-composer)

2. Зайти в контейнер project_app командой docker exec -it project_app bash и создать зависимости командой composer install. Создать файл .env и в нём прописать коннект к базе данный в виде 

DB_CONNECTION=mysql

DB_HOST=db

DB_PORT=3306

DB_DATABASE=larnote

DB_USERNAME=root

DB_PASSWORD=root 

Пример этого файла в .env.examples нужно только прописать параметры

3. В контейнере project_app запустить laravel миграции командой php artisan migrate:refresh
4. прописать адрес localhosta в файле config/l5-swagger.php
5. Выполнить команду php artisan l5-swagger:generate
P.S. Возможно нужно будет дать права на запись в некоторых папках laravel, но встроенные исключения укажит в какиэ после запуска приложения

Запуск приложения :
После всех вышеперчисленных действий api документация будет доступна (Вместо **** указанный вами порт) по адресу: http://localhost:****/api/documentation#/
