# Bookmarks

Пример рабочего приложения:

[https://bookmarks.q0p.ru](https://bookmarks.q0p.ru)

## Что сделано

### Основное задание

По основному заданию всё учтено.

### Сортировка

Сортировка реализуется по клику на столбец.

Использован пакет `kyslik/column-sortable`.

### Экспорт

Внимание: при выгрузке 100 000 записей, нужно подождать.

Использован пакет `maatwebsite/excel`.

### Удаление

Пароль для удаления указывается при создании закладки (если необходимо).

### Поиск

Добавил индексы на столбцы по которым ведется поиск. По хорошему, лучше посмотреть в сторону ElasticSearch или Algolia.

## Как запустить

Комманды в консоли

```console
git clone https://github.com/mikesvis/bookmarks.git
cd bookmarks
cp .env.example .env
composer install
php artisan key:generate
```

Обновляем конфигурацию подключения к базе в `.env`

```
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
```

```console
# Мигрируем
$ php artisan migrate

# Soft seeder (50 записей)
$ php artisan db:seed

# Это hard seeder (100 000 записей)
$ php artisan db:seed --class BookmarkHardSeeder

# Сервер
php artisan serve
```

Profit!
