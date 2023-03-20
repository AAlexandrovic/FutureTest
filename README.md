Установка приложения:

1. Скопировать репозиторий командой https://github.com/AAlexandrovic/FutureTest.git 
Внутри docker-compose.yml Можно изменить значения на нужные, например если вы не хотите открывать приложение портом 8876(уже прописанным) , то измените порт на нужный Вам, например 8080:80.
Запустить сборку командой docker-compose up -d
(Должны быть установленны docker и docker-composer)

2. Зайти в контейнер project_app командой docker exec -it project_app bash и создать зависимости командой composer install

3. В контейнере запустить laravel миграции командой php artisan migrate:refresh

Запуск приложения :
После всех вышеперчисленных действий api документация будет доступна (если вы не меняли адрес порта) по адресу: http://localhost:8876/api/documentation#/
